import 'dart:convert';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:http/http.dart' as http;
import '../models/order_model.dart';

class OrderHistoryService {
  static const String baseUrl =
      'http://192.168.1.16/skripsi-dian-pnp/backend_apk/public/api';
  final storage = const FlutterSecureStorage();

  Future<List<Order>> getOrders() async {
    final token = await storage.read(key: 'token');
    final userId = await storage.read(key: 'user_id');
    if (userId == null) throw Exception('User ID not found');

    final response = await http.get(
      Uri.parse('$baseUrl/pesanan/histori/$userId'),
      headers: {
        'Authorization': 'Bearer $token',
        'Content-Type': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      final List<dynamic> data = jsonDecode(response.body)['data'];
      return data.map((json) => Order.fromJson(json)).toList();
    } else {
      throw Exception('Failed to load orders');
    }
  }

  Future<Order> getOrderDetail(String orderId) async {
    final token = await storage.read(key: 'token');

    final response = await http.get(
      Uri.parse('$baseUrl/pesanan/$orderId'),
      headers: {
        'Authorization': 'Bearer $token',
        'Content-Type': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body)['data'];
      return Order.fromJson(data);
    } else {
      throw Exception('Failed to load order detail');
    }
  }

  Future<bool> cancelOrder(String orderId) async {
    try {
      final token = await storage.read(key: 'token');

      final response = await http.post(
        Uri.parse('$baseUrl/pesanan/$orderId/cancel'),
        headers: {
          'Authorization': 'Bearer $token',
          'Content-Type': 'application/json',
        },
      );

      return response.statusCode == 200;
    } catch (e) {
      throw Exception('Failed to cancel order: $e');
    }
  }
}
