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
            // Set Midtrans configuration
            \Midtrans\Config::$serverKey = config('services.midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');

            Log::debug('Webhook raw payload', ['body' => $request->getContent()]);
            $notification = new Notification();

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $paymentType = $notification->payment_type;

            Log::debug('Webhook order_id', ['order_id' => $orderId]);
            Log::info('Midtrans notification received', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'metode_pembayaran' => $paymentType
            ]);

            $order = Order::where('order_id', $orderId)->first();
            $pesan = Pesanan::where('order_id', $orderId)->first();
            Log::debug('Pesanan ditemukan?', ['found' => $order ? 'ya' : 'tidak']);
            if (!$order) {
                Log::error("Pesanan tidak ditemukan: $orderId");
                return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
            }

            $statusPesanan = 'Menunggu Pembayaran';

            switch ($transactionStatus) {
                case 'capture':
                    if ($fraudStatus == 'challenge') {
                        $statusPesanan = 'Menunggu Konfirmasi';
                    } else if ($fraudStatus == 'accept') {
                        $statusPesanan = 'paid';
                    }
                    break;
                case 'settlement':
                    $statusPesanan = 'paid';
                    break;
                case 'pending':
                    $statusPesanan = 'pending';
                    break;
                case 'deny':
                case 'expire':
                case 'cancel':
                    $statusPesanan = 'Failed';
                    break;
                default:
                    $statusPesanan = 'Waiting Payment';
                    break;
            }

            Log::debug('Update pesanan', [
                'order_id' => $orderId,
                'status_baru' => $statusPesanan,
                'metode_pembayaran' => $paymentType
            ]);
            $pesan->status = $statusPesanan;
            $order->status = $statusPesanan;
            $order->metode_pembayaran = $paymentType;
            $order->save();

            Log::info("Status pesanan $orderId diperbarui ke: $statusPesanan");
            return response()->json(['message' => 'Notification handled successfully']);
        } catch (\Exception $e) {
            Log::error('Error handling notification: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
