import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter_secure_storage/flutter_secure_storage.dart';

class OrderService {
  final String baseUrl =
      'http://192.168.1.16/skripsi-dian-pnp/backend_apk/public/api';
  final storage = const FlutterSecureStorage();

  /// =============================
  /// Ambil histori pesanan user
  /// =============================
  Future<Map<String, dynamic>> getOrderHistory() async {
    try {
      final token = await storage.read(key: 'token');
      final userId = await storage.read(key: 'user_id');

      if (userId == null) throw Exception('User ID tidak ditemukan');
      if (token == null) {
        throw Exception('Token tidak ditemukan. Silahkan login ulang');
      }

      print('Fetching order history for user $userId');
      final url = Uri.parse('$baseUrl/pesanan/histori/$userId');

      final response = await http.get(
        url,
        headers: {
          'Authorization': 'Bearer $token',
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        },
      );

      print('Response status: ${response.statusCode}');
      print('Response body: ${response.body}');

      if (response.statusCode == 200) {
        return jsonDecode(response.body);
      } else if (response.statusCode == 401) {
        throw Exception('Sesi telah berakhir. Silahkan login ulang');
      } else {
        final error = jsonDecode(response.body);
        throw Exception(error['message'] ?? 'Gagal mengambil histori pesanan');
      }
    } catch (e) {
      print('Error in getOrderHistory: $e');
      throw Exception('Error: $e');
    }
  }

  /// =============================
  /// Buat pesanan baru
  /// =============================
  Future<Map<String, dynamic>> createOrder(
      List<Map<String, dynamic>> items) async {
    try {
      final token = await storage.read(key: 'token');
      final userId = await storage.read(key: 'user_id');
      final nama = await storage.read(key: 'name') ?? 'Customer';

      if (userId == null) throw Exception('User ID tidak ditemukan');
      if (token == null) throw Exception('Token tidak ditemukan');

      print('Creating order with: userId=$userId, name=$nama');
      print('Items to be ordered: $items');

      final data = {
        'user_id': userId,
        'nama_pelanggan': nama,
        'items': items.map((item) {
          final menuId = item['menu_id'];
          final quantity = item['quantity'];

          if (menuId == null) throw Exception('Menu ID tidak boleh kosong');
          if (quantity == null) throw Exception('Quantity tidak boleh kosong');

          return {
            'menu_id': menuId,
            'quantity': quantity,
          };
        }).toList(),
      };

      print('Sending request to: $baseUrl/pesanan');
      print('Request data: ${jsonEncode(data)}');

      final response = await http.post(
        Uri.parse('$baseUrl/pesanan'),
        headers: {
          'Authorization': 'Bearer $token',
          'Content-Type': 'application/json',
        },
        body: jsonEncode(data),
      );

      print('Response status: ${response.statusCode}');
      print('Response body: ${response.body}');

      if (response.statusCode == 200) {
        final Map<String, dynamic> responseData = jsonDecode(response.body);

        if (!responseData.containsKey('data')) {
          throw Exception('Response missing data field');
        }

        final data = responseData['data'] as Map<String, dynamic>;
        final pesanan = data['pesanan'] as Map<String, dynamic>;
        final orderId = pesanan['order_id'];
        final snapToken = data['snap_token'];

        if (orderId == null || snapToken == null) {
          throw Exception(
              'Invalid response format: missing order_id or snap_token');
        }

        // Tambahkan ke response biar gampang dipakai di Flutter
        responseData['order_id'] = orderId;
        responseData['snap_token'] = snapToken;
        responseData['payment_url'] =
            'https://app.sandbox.midtrans.com/snap/v2/vtweb/$snapToken';

        print('Order created successfully: $responseData');
        return responseData;
      } else {
        throw Exception('Failed to create order: ${response.statusCode}');
      }
    } catch (e) {
      print('Error creating order: $e');
      throw Exception('Failed to create order: $e');
    }
  }
}
