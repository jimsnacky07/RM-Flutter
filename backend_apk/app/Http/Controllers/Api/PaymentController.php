<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = 'SB-Mid-server-dfoOX8N1GjqrwYTGmFaVup8D';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
    public function process(Request $request)
    {
        try {
            // Ambil pesanan berdasarkan order_id
            $pesanan = Pesanan::with('detailPesanan.menu')
                ->where('order_id', $request->order_id)
                ->firstOrFail();

            // Siapkan item details untuk Midtrans
            $itemDetails = [];
            foreach ($pesanan->detailPesanan as $detail) {
                $itemDetails[] = [
                    'id' => $detail->menu->id,
                    'price' => $detail->harga,
                    'quantity' => $detail->jumlah,
                    'name' => $detail->menu->nama
                ];
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $pesanan->order_id,
                    'gross_amount' => (int) $pesanan->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $pesanan->nama_pelanggan,
                    'email' => $pesanan->user->email ?? 'customer@mail.com',
                    'phone' => $pesanan->user->phone ?? '08123456789',
                ],
                'item_details' => $itemDetails,
                'enabled_payments' => [
                    'credit_card',
                    'gopay',
                    'shopeepay',
                    'bank_transfer',
                    'bca_va',
                    'bni_va',
                    'bri_va',
                    'echannel',
                    'other_va',
                    'danamon_online',
                    'qris'
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            // Update pesanan with payment method if provided
            $pesanan = Pesanan::where('order_id', $request->input('transaction_details.order_id'))->first();
            if ($pesanan && $request->has('payment_type')) {
                $pesanan->update(['metode' => $request->payment_type]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Snap token created successfully',
                'data' => [
                    'snap_token' => $snapToken,
                    'payment_url' => "https://app.sandbox.midtrans.com/snap/v2/vtweb/$snapToken"
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans payment processing error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses pembayaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $orderId)
    {
        try {
            $pesanan = Pesanan::where('order_id', $orderId)->firstOrFail();

            Log::info('Updating payment status manually:', [
                'order_id' => $orderId,
                'current_status' => $pesanan->status,
                'current_metode' => $pesanan->metode
            ]);

            $pesanan->update([
                'status' => 'Diproses',
                'metode' => $request->metode ?? 'bank_transfer',
            ]);

            Log::info('Payment status updated manually:', [
                'order_id' => $orderId,
                'new_status' => $pesanan->status,
                'new_metode' => $pesanan->metode
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status pembayaran berhasil diupdate',
                'data' => $pesanan
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating payment status:', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status pembayaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
