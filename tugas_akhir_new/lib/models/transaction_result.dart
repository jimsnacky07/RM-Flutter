class TransactionResult {
  final String? orderId;
  final String? paymentType;
  final String? transactionId;
  final String? status;
  final String? paymentCode;
  final String? finishRedirectUrl;
  final String? deepLinkUrl;
  final String? qrCodeUrl;

  TransactionResult({
    this.orderId,
    this.paymentType,
    this.transactionId,
    this.status,
    this.paymentCode,
    this.finishRedirectUrl,
    this.deepLinkUrl,
    this.qrCodeUrl,
  });

  factory TransactionResult.fromJson(Map<String, dynamic> json) {
    return TransactionResult(
      orderId: json['order_id'],
      paymentType: json['payment_type'],
      transactionId: json['transaction_id'],
      status: json['transaction_status'] ?? json['status_code'],
      paymentCode: json['payment_code'],
      finishRedirectUrl: json['finish_redirect_url'],
      deepLinkUrl: json['deeplink_url'],
      qrCodeUrl: json['qr_code_url'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'order_id': orderId,
      'payment_type': paymentType,
      'transaction_id': transactionId,
      'transaction_status': status,
      'payment_code': paymentCode,
      'finish_redirect_url': finishRedirectUrl,
      'deeplink_url': deepLinkUrl,
      'qr_code_url': qrCodeUrl,
    };
  }
}
