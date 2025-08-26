<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Transaction;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class PaymentStatusController extends Controller
{
    public function check($orderId)
    {
        $order = Order::where('order_id', $orderId)->first();
        if (!$order) {
            return response()->json([
                'error' => 'Order not found',
                'message' => 'Order ID tidak ditemukan'
            ], 404);
        }

        try {
            // Coba ambil status Midtrans
            $midtransStatus = Transaction::status($orderId);
            $status = $midtransStatus['transaction_status'] ?? 'pending';
        } catch (\Exception $e) {
            // Jika Midtrans error (sandbox 401), fallback ke DB lokal
            $status = $order->status;
        }

        return response()->json([
            'order_id' => $order->order_id,
            'transaction_id' => $order->transaction_id ?? '',
            'transaction_status' => $status,
            'payment_type' => $order->metode_pembayaran ?? '',
            'gross_amount' => $order->total_harga,
            'transaction_time' => $order->updated_at->format('Y-m-d H:i:s'),
        ]);
    }
}
