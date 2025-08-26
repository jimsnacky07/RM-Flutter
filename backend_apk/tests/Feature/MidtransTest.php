<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pesanan;

class MidtransTest extends TestCase
{
    public function testCallbackSuccess()
    {
        // Create a test order
        $orderId = 'TEST-ORDER-' . time();
        $pesanan = Pesanan::create([
            'order_id' => $orderId,
            'user_id' => '99',
            'nama_pelanggan' => 'Test User',
            'status' => 'Menunggu Pembayaran',
            'total_harga' => 30000,
            'detail' => '[{"menu_id":4,"quantity":1}]',
            'snap_token' => 'test-token-' . time()
        ]);

        // Simulate Midtrans callback notification
        $notificationPayload = [
            "transaction_time" => date('Y-m-d H:i:s'),
            "transaction_status" => "settlement",
            "transaction_id" => "test-transaction-" . time(),
            "status_message" => "midtrans payment notification",
            "status_code" => "200",
            "signature_key" => "test-signature-key",
            "payment_type" => "bank_transfer",
            "order_id" => $orderId,
            "merchant_id" => "test-merchant",
            "gross_amount" => "30000.00",
            "fraud_status" => "accept",
            "currency" => "IDR"
        ];

        // Send POST request to callback endpoint
        $response = $this->withHeaders([
            'X-Signature-Key' => 'test-signature-key',
            'Accept' => 'application/json'
        ])->json('POST', '/api/midtrans/callback', $notificationPayload);

        // Assert response is successful
        $response->assertStatus(200);

        // Verify order status is updated
        $this->assertDatabaseHas('pesanan', [
            'order_id' => $orderId,
            'status' => 'Pembayaran Berhasil'
        ]);
    }
}
