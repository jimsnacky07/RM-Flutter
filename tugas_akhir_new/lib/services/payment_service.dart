import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/midtrans_payment.dart';

class PaymentService {
  final String baseUrl = 'http://your-backend-url/api';

  Future<String> createPayment({
    required String orderId,
    required double amount,
    required String customerName,
    required String customerEmail,
    required String customerPhone,
    required List<Map<String, dynamic>> items,
  }) async {
    try {
      final response = await http.post(
        Uri.parse('$baseUrl/payment/process'),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: jsonEncode({
          'transaction_details': {
            'order_id': orderId,
            'gross_amount': amount,
          },
          'customer_details': {
            'first_name': customerName,
            'email': customerEmail,
            'phone': customerPhone,
          },
          'item_details': items,
        }),
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        return data['snap_token'];
      } else {
        throw Exception('Failed to create payment');
      }
    } catch (e) {
      throw Exception('Error creating payment: $e');
    }
  }

  Future<MidtransPayment> checkPaymentStatus(String orderId) async {
    try {
      final response = await http.get(
        Uri.parse('$baseUrl/payment/status/$orderId'),
        headers: {
          'Accept': 'application/json',
        },
      );

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        return MidtransPayment.fromJson(data);
      } else {
        throw Exception('Failed to check payment status');
      }
    } catch (e) {
      throw Exception('Error checking payment status: $e');
    }
  }
}
