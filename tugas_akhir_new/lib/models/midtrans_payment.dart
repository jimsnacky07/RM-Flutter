class MidtransPayment {
  final String orderId;
  final String transactionId;
  final String paymentType;
  final String status;
  final Map<String, dynamic> paymentData;

  MidtransPayment({
    required this.orderId,
    required this.transactionId,
    required this.paymentType,
    required this.status,
    required this.paymentData,
  });

  factory MidtransPayment.fromJson(Map<String, dynamic> json) {
    // Extract payment specific data
    Map<String, dynamic> paymentData = {};

    switch (json['payment_type']) {
      case 'bank_transfer':
        paymentData = {
          'va_numbers': json['va_numbers'] ?? [],
          'payment_code': json['payment_code'],
          'bill_key': json['bill_key'],
          'biller_code': json['biller_code'],
          'instructions': json['payment_instructions'] ?? [],
        };
        break;
      case 'qris':
        paymentData = {
          'qr_code_url': json['qr_string'] ?? json['qr_code_url'],
          'instructions': json['payment_instructions'] ?? [],
        };
        break;
      case 'gopay':
        paymentData = {
          'actions': json['actions'] ?? [],
          'instructions': json['payment_instructions'] ?? [],
        };
        break;
    }

    return MidtransPayment(
      orderId: json['order_id'] ?? '',
      transactionId: json['transaction_id'] ?? '',
      paymentType: json['payment_type'] ?? '',
      status: json['transaction_status'] ?? 'pending',
      paymentData: paymentData,
    );
  }
}

class PaymentInstructions {
  final String bank;
  final String vaNumber;
  final String? qrCodeUrl;
  final List<String> instructions;

  PaymentInstructions({
    required this.bank,
    required this.vaNumber,
    this.qrCodeUrl,
    required this.instructions,
  });

  factory PaymentInstructions.fromJson(Map<String, dynamic> json) {
    return PaymentInstructions(
      bank: json['bank'] ?? '',
      vaNumber: json['va_number'] ?? '',
      qrCodeUrl: json['qr_code_url'],
      instructions: List<String>.from(json['instructions'] ?? []),
    );
  }
}
