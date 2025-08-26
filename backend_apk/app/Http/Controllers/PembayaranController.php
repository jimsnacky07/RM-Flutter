<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

class PembayaranController extends Controller
{
    public function createSnapToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'total'   => 'required|numeric|min:1',
            'nama'    => 'nullable|string',
            'email'   => 'nullable|email',
            'metode'  => 'nullable|string',
            'items'   => 'nullable',
            'detail_pesanan' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Midtrans Config
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = (bool) config('midtrans.is_production', false);
        Config::$isSanitized  = true;
        Config::$is3ds        = true;

        if (!Config::$serverKey) {
            return response()->json([
                'success' => false,
                'message' => 'MIDTRANS_SERVER_KEY tidak ditemukan',
            ], 500);
        }

        // Ambil items baik dari "items" atau "detail_pesanan"
        $itemsRaw = $request->items ?? $request->detail_pesanan;
        $items    = is_array($itemsRaw) ? $itemsRaw : json_decode($itemsRaw, true);

        if (!is_array($items) || empty($items)) {
            return response()->json([
                'success' => false,
                'message' => 'Data items/detail_pesanan tidak valid',
            ], 400);
        }

        $orderId = 'ORDER-' . $request->user_id . '-' . now()->timestamp;

        $order = Order::create([
            'user_id'           => $request->user_id,
            'order_id'          => $orderId,
            'total_harga'       => $request->total,
            'status'            => 'pending',
            'metode_pembayaran' => $request->metode ?? 'midtrans',
            'catatan'           => $request->catatan ?? null,
            'items'             => json_encode($items),
            'snap_token'        => null,
        ]);

        // Format item_details sesuai Midtrans
        $itemDetails = [];
        foreach ($items as $it) {
            $itemDetails[] = [
                'id'       => (string)($it['id'] ?? $it['menu_id'] ?? uniqid()),
                'price'    => (int)($it['harga'] ?? $it['price'] ?? 0),
                'quantity' => (int)($it['jumlah'] ?? $it['qty'] ?? 1),
                'name'     => $it['nama'] ?? $it['namaMenu'] ?? 'Produk',
            ];
        }

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $request->total,
            ],
            'customer_details' => [
                'first_name' => $request->nama  ?: 'Customer',
                'email'      => $request->email ?: 'customer@example.com',
            ],
            'enabled_payments' => ['qris','bca_va','bri_va','mandiri_va','gopay','shopeepay'],
            'item_details'     => $itemDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            $order->update([
                'snap_token' => $snapToken,
                'status'     => 'waiting_payment',
            ]);

            return response()->json([
                'success'    => true,
                'message'    => 'Snap token berhasil dibuat',
                'snap_token' => $snapToken,
                'order'      => $order,
            ]);
        } catch (\Throwable $e) {
            Log::error('Midtrans Snap Error', [
                'error'  => $e->getMessage(),
                'params' => $params,
            ]);

            $order->update([
                'status'     => 'failed',
                'snap_token' => null,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi: ' . $e->getMessage(),
                'order'   => $order,
            ], 502);
        }
    }

    public function callback(Request $request)
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = (bool) config('midtrans.is_production', false);

        try {
            $signature = hash('sha512',
                $request->order_id .
                $request->status_code .
                (string)$request->gross_amount .   // 🔥 pastikan string
                Config::$serverKey
            );

            if ($signature !== $request->signature_key) {
                Log::warning("Invalid signature callback untuk order {$request->order_id}");
                return response()->json(['message' => 'Invalid signature'], 403);
            }

            $order = Order::where('order_id', $request->order_id)->first();
            if (!$order) {
                return response()->json(['message' => 'Order tidak ditemukan'], 404);
            }

            $status = match ($request->transaction_status) {
                'capture', 'settlement' => 'success',
                'pending'               => 'pending',
                'deny'                  => 'denied',
                'expire'                => 'expired',
                'cancel'                => 'cancelled',
                default                 => 'pending',
            };

            $order->update(['status' => $status]);
            Log::info("Callback sukses: Order {$order->id} status -> {$status}");

            return response()->json([
                'success' => true,
                'message' => 'Callback processed',
                'status'  => $status,
            ]);
        } catch (\Throwable $e) {
            Log::error('Midtrans Callback Error', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Callback error'], 500);
        }
    }
}
