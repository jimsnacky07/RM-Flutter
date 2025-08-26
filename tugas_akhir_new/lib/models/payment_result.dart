class PaymentResult {
  final String status;
  final String statusMessage;

  PaymentResult({
    required this.status,
    required this.statusMessage,
  });

  bool get isSuccess => status == 'success';
  bool get isFailed => status == 'failed';

  factory PaymentResult.fromString(String result) {
    switch (result) {
      case 'success':
        return PaymentResult(
          status: 'success',
          statusMessage: 'Pembayaran berhasil',
        );
      case 'failed':
        return PaymentResult(
          status: 'failed',
          statusMessage: 'Pembayaran gagal',
        );
      default:
        return PaymentResult(
          status: 'failed',
          statusMessage: 'Status pembayaran tidak diketahui',
        );
    }
  }
}
