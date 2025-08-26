class MidtransPayment {
  final String orderId;
  final String transactionId;
  final String paymentType;
  final String transactionStatus;
  final Map<String, dynamic> paymentData;
  final String grossAmount;
  final String transactionTime;
  final String statusCode;
  final String fraudStatus;

  MidtransPayment({
    required this.orderId,
    required this.transactionId,
    required this.paymentType,
    required String status,
    required this.paymentData,
    this.grossAmount = '0',
    this.transactionTime = '',
    this.statusCode = '',
    this.fraudStatus = '',
  }) : transactionStatus = status;

  // Status getter
  bool get isSuccess =>
      transactionStatus.toLowerCase() == 'settlement' ||
      transactionStatus.toLowerCase() == 'paid';

  bool get isPending => transactionStatus.toLowerCase() == 'pending';

  bool get isFailed =>
      transactionStatus.toLowerCase() == 'deny' ||
      transactionStatus.toLowerCase() == 'cancel' ||
      transactionStatus.toLowerCase() == 'expire';

  factory MidtransPayment.fromJson(Map<String, dynamic> json) {
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
      grossAmount: json['gross_amount']?.toString() ?? '0',
      transactionTime: json['transaction_time'] ?? '',
      statusCode: json['status_code']?.toString() ?? '',
      fraudStatus: json['fraud_status'] ?? '',
    );
  }
}
