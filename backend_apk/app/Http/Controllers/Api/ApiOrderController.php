<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Validator;

class ApiOrderController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Buat order
            $orderId = 'ORDER-' . $request->user()->id . '-' . time();
            $totalAmount = 0;

            // Hitung total amount dan siapkan item details untuk Midtrans
            $itemDetails = [];
            foreach ($request->items as $item) {
                $menu = \App\Models\Menu::find($item['menu_id']);
                $subtotal = $menu->harga * $item['quantity'];
                $totalAmount += $subtotal;

                $itemDetails[] = [
                    'id' => $menu->id,
                    'price' => $menu->harga,
                    'quantity' => $item['quantity'],
                    'name' => $menu->nama
                ];
            }

            // Simpan order ke database
            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_id' => $orderId,
                'total_harga' => $totalAmount,
                'status' => 'pending',
                'metode_pembayaran' => 'midtrans',
                'items' => json_encode($request->items)
            ]);

            // Siapkan parameter untuk Midtrans
            $transactionDetails = [
                'order_id' => $orderId,
                'gross_amount' => $totalAmount,
            ];

            $customerDetails = [
                'first_name' => $request->user()->nama,
                'email' => $request->user()->email,
            ];

            $midtransParams = [
                'transaction_details' => $transactionDetails,
                'customer_details' => $customerDetails,
                'item_details' => $itemDetails
            ];

            // Get Snap Payment Page URL
            $snapToken = Snap::getSnapToken($midtransParams);

            // Update order dengan snap token
            $order->snap_token = $snapToken;
            $order->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => [
                    'order' => $order,
                    'snap_token' => $snapToken
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error creating order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOrderStatus($orderId)
    {
        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'order_status' => $order->status,
                'payment_status' => $order->payment_status ?? null,
                'order_details' => $order
            ]
        ]);
    }

    // Callback dari Midtrans
    public function handlePaymentNotification(Request $request)
    {
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        $order = Order::where('order_id', $orderId)->first();

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->status = 'challenge';
                } else {
                    $order->status = 'success';
                }
            }
        } else if ($transaction == 'settlement') {
            $order->status = 'success';
        } else if ($transaction == 'pending') {
            $order->status = 'pending';
        } else if ($transaction == 'deny') {
            $order->status = 'denied';
        } else if ($transaction == 'expire') {
            $order->status = 'expired';
        } else if ($transaction == 'cancel') {
            $order->status = 'canceled';
        }

        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Payment notification handled successfully'
        ]);
    }
}
