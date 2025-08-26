<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Log raw request untuk debugging
        Log::info('Midtrans Callback received:', [
            'raw_request' => $request->getContent(),
            'headers' => $request->headers->all()
        ]);

        $json = json_decode($request->getContent());

        // Log decoded JSON
        Log::info('Decoded notification:', [
            'json' => json_encode($json, JSON_PRETTY_PRINT)
        ]);

        // Ambil order_id dari notifikasi
        $order_id = $json->order_id;
        Log::info('Processing order:', ['order_id' => $order_id]);

        // Cari pesanan berdasarkan order_id
        $pesanan = Pesanan::where('order_id', $order_id)->first();

        Log::info('Found order:', [
            'pesanan_exists' => ($pesanan !== null),
            'pesanan_id' => $pesanan ? $pesanan->id : null
        ]);

        if ($pesanan) {
            // Update status pesanan
            $transaction = $json->transaction_status;
            $type = $json->payment_type;
            $fraud = $json->fraud_status;

            $status = 'Menunggu Pembayaran';

            if ($transaction == 'capture') {
                // For credit card transaction
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $status = 'Menunggu Pembayaran';
                    } else {
                        $status = 'Diproses';
                    }
                }
            } else if ($transaction == 'settlement') {
                $status = 'Diproses';
            } else if ($transaction == 'pending') {
                $status = 'Menunggu Pembayaran';
            } else if ($transaction == 'deny') {
                $status = 'Dibatalkan';
            } else if ($transaction == 'expire') {
                $status = 'Dibatalkan';
            } else if ($transaction == 'cancel') {
                $status = 'Dibatalkan';
            }

            // Tentukan metode pembayaran yang lebih spesifik
            $metode = $type;
            if ($type == 'bank_transfer') {
                $metode = isset($json->va_numbers[0]->bank) ? strtoupper($json->va_numbers[0]->bank) : 'Virtual Account';
            } elseif ($type == 'echannel') {
                $metode = 'Mandiri Bill';
            } elseif ($type == 'gopay') {
                $metode = 'GoPay';
            } elseif ($type == 'credit_card') {
                $metode = isset($json->card_type) ? strtoupper($json->card_type) : 'Credit Card';
            } elseif ($type == 'shopeepay') {
                $metode = 'ShopeePay';
            } elseif ($type == 'qris') {
                $metode = 'QRIS';
            }

            // Log payment details before update
            Log::info('Payment details:', [
                'transaction_status' => $transaction,
                'payment_type' => $type,
                'calculated_status' => $status,
                'calculated_metode' => $metode
            ]);

            // Prepare update data
            $updateData = [
                'status' => $status,
                'metode' => $metode,
                'payment_type' => $type,
                'transaction_id' => $json->transaction_id ?? null,
                'transaction_status' => $transaction,
                'payment_time' => isset($json->settlement_time) ?
                    Carbon::parse($json->settlement_time) : null,
                'va_number' => $json->va_numbers[0]->va_number ?? null,
                'bank' => $json->va_numbers[0]->bank ?? null,
            ];

            Log::info('Updating order with data:', [
                'pesanan_id' => $pesanan->id,
                'update_data' => $updateData
            ]);

            // Update data pesanan
            try {
                $pesanan->update($updateData);

                // Verify the update
                $pesanan->refresh();
                Log::info('Order updated successfully:', [
                    'pesanan_id' => $pesanan->id,
                    'new_status' => $pesanan->status,
                    'new_metode' => $pesanan->metode,
                    'new_payment_type' => $pesanan->payment_type
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to update order:', [
                    'pesanan_id' => $pesanan->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Order not found']);
    }
}
