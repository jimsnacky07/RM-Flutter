<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Midtrans\Transaction;

class PaymentStatusController extends Controller
{
    public function check($orderId)
    {
        try {
            $status = Transaction::status($orderId);
            return response()->json($status);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to check payment status',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
