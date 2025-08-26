<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pesanan;

class MidtransCallbackController extends Controller
{
    public function notification(Request $request)
    {
        try {
            // Konfigurasi Midtrans
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');

            $notification = new Notification();

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $paymentType = $notification->payment_type;

            $order = Order::where('order_id', $orderId)->first();
            $pesan = Pesanan::where('order_id', $orderId)->first();

            if (!$order || !$pesan) {
                Log::error("Pesanan tidak ditemukan: $orderId");
                return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
            }

            // Tentukan status baru untuk orders
            $statusOrder = match ($transactionStatus) {
                'capture' => $fraudStatus == 'accept' ? 'paid' : 'Menunggu Konfirmasi',
                'settlement' => 'paid',
                'pending' => 'pending',
                'deny', 'expire', 'cancel' => 'failed',
                default => 'Menunggu Pembayaran',
            };

            // Update orders
            $order->status = $statusOrder;
            $order->metode_pembayaran = $paymentType;
            $order->save();

            // Tentukan status dan metode untuk pesanans
            if ($statusOrder === 'paid') {
                $pesan->status = 'Diproses';
            } elseif ($statusOrder === 'pending') {
                $pesan->status = 'Menunggu Pembayaran';
            } elseif ($statusOrder === 'failed') {
                $pesan->status = 'Gagal';
            } else {
                $pesan->status = $statusOrder;
            }

            // Tentukan metode pembayaran untuk tabel pesanans
            $pesan->metode = match ($paymentType) {
                'bank_transfer' => 'Virtual Account Bank ' . ($notification->va_numbers[0]->bank ?? ''),
                'gopay', 'qris', 'shopeepay' => 'E-wallet',
                default => 'Lainnya',
            };

            $pesan->save();

            Log::info("Status pesanan $orderId diperbarui - orders: $statusOrder, pesanans: {$pesan->status}, metode: {$pesan->metode}");

            return response()->json(['message' => 'Notification handled successfully']);
        } catch (\Exception $e) {
            Log::error('Error handling notification: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
