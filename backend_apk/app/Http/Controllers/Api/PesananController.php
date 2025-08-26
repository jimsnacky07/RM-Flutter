<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            Log::debug('PesananController.store request', ['body' => $request->all()]);
            // --- Hitung total ---
            $total = 0;
            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                $total += $menu->harga * $item['quantity'];
            }

            // --- Simpan Pesanan ---
            $pesanan = Pesanan::create([
                'user_id' => $request->user()->id ?? null,
                'nama_pelanggan' => $request->nama_pelanggan,
                'order_id' => uniqid(),
                'total_harga' => $total,
                'status' => 'Menunggu Pembayaran', // default status
            ]);
            $order = Order::create([
                'user_id' => $request->user()->id ?? null,
                'order_id' => $pesanan->order_id,
                'total_harga' => $total,
                'status' => 'Pending',
            ]);
            Log::debug('Pesanan baru dibuat', ['order_id' => $pesanan->order_id, 'user_id' => $pesanan->user_id, 'total_harga' => $pesanan->total_harga]);

            // --- Simpan Detail Pesanan ---
            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['menu_id']);
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $menu->id,
                    'jumlah' => $item['quantity'],
                    'harga' => $menu->harga,
                    'subtotal' => $menu->harga * $item['quantity'],
                ]);
            }

            // --- Konfigurasi Midtrans ---
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            // --- Midtrans params ---
            $params = [
                'transaction_details' => [
                    'order_id' => $pesanan->order_id,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_pelanggan,
                    'email' => $request->user()->email ?? 'noemail@example.com', // default jika null
                ],
            ];
            Log::debug('Midtrans Snap params', $params);
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            DB::commit();
            Log::debug('Snap token didapat', ['snap_token' => $snapToken]);
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'data' => [
                    'pesanan' => $pesanan,
                    'snap_token' => $snapToken,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Pesanan error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function history($userId)
    {
        try {
            $pesanan = Pesanan::with('detailPesanan.menu')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $pesanan,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
