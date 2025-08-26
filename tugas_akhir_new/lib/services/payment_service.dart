import 'dart:async';
import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/midtrans_payment.dart';

class PaymentService {
  final String baseUrl;

  PaymentService({required this.baseUrl});

  Future<MidtransPayment> checkPaymentStatus(String orderId) async {
    final url = Uri.parse('$baseUrl/api/payments/status/$orderId');
    final response = await http.get(url);
    print('status code: ${response.statusCode}');
    print('body: ${response.body}');

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      return MidtransPayment.fromJson(data);
    } else {
      throw Exception('Failed to fetch payment status: ${response.statusCode}');
    }
  }

  Stream<MidtransPayment> watchPaymentStatus(String orderId,
      {Duration interval = const Duration(seconds: 5)}) async* {
    while (true) {
      try {
        final payment = await checkPaymentStatus(orderId);
        yield payment;

        // Stop polling if payment is success or failed
        if (payment.isSuccess || payment.isFailed) break;
      } catch (e) {
        yield MidtransPayment(
          orderId: orderId,
          transactionId: '',
          paymentType: '',
          status: 'failed',
          paymentData: {},
        );
        break;
      }
      await Future.delayed(interval);
    }
  }
}
