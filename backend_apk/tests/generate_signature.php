<?php

echo "Generating Midtrans test data...\n\n";

$orderId = "ORD-31-68ac2579c1699";
$statusCode = "200";
$grossAmount = "100000.00";

$input = $orderId . $statusCode . $grossAmount . $serverKey;
$signature = hash('sha512', $input);

echo "Test Parameters:\n";
echo "Order ID: " . $orderId . "\n";
echo "Status Code: " . $statusCode . "\n";
echo "Gross Amount: " . $grossAmount . "\n";
echo "Generated Signature Key: " . $signature . "\n";

// Contoh request body untuk test
$testCases = [
    'bank_transfer' => [
        "transaction_status" => "settlement",
        "status_code" => "200",
        "signature_key" => $signature,
        "payment_type" => "bank_transfer",
        "order_id" => $orderId,
        "merchant_id" => "G812785002",
        "gross_amount" => $grossAmount,
        "fraud_status" => "accept",
        "currency" => "IDR",
        "transaction_id" => "9aed5972-5b6a-4a56-a810-87b08f32a13a",
        "transaction_time" => "2025-08-25 09:00:00",
        "settlement_time" => "2025-08-25 09:05:00",
        "status_message" => "Success",
        "va_numbers" => [
            [
                "bank" => "bca",
                "va_number" => "12345678901"
            ]
        ]
    ]
];

echo "\nRequest Body untuk Bank Transfer:\n";
echo json_encode($testCases['bank_transfer'], JSON_PRETTY_PRINT);
