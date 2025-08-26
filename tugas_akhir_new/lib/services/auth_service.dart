import 'dart:convert';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:http/http.dart' as http;

class AuthService {
  static const String baseUrl = 'http://192.168.1.16/skripsi-dian-pnp/backend_apk/public/api';
  final storage = const FlutterSecureStorage();

  Future<Map<String, dynamic>> login(String email, String password) async {
    final response = await http.post(
      Uri.parse('$baseUrl/auth/login'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode({
        'email': email,
        'password': password,
      }),
    );

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      print('Response data: $data'); // Debug print
      print(
          'Token type: ${data['data']['token'].runtimeType}'); // Check token type

      // Store the token and user data
      if (data['data'] != null && data['data']['token'] != null) {
        final userData = data['data'];
        final userId = userData['id'].toString();
        final nama = userData['nama'].toString();
        final token = userData['token'].toString();

        // Store the token directly
        await storage.write(key: 'token', value: token);
        await storage.write(key: 'user_id', value: userId);
        await storage.write(key: 'name', value: nama);

        print(
            'Stored token: ${await storage.read(key: 'token')}'); // Debug print
      } else {
        throw Exception('Invalid response format: missing token or user data');
      }

      return data;
    } else {
      throw Exception('Failed to login');
    }
  }

  Future<void> logout() async {
    final token = await storage.read(key: 'token');

    try {
      await http.post(
        Uri.parse('$baseUrl/auth/logout'),
        headers: {
          'Authorization': 'Bearer $token',
          'Content-Type': 'application/json',
        },
      );
    } finally {
      // Clear all stored user data regardless of API call success
      await storage.delete(key: 'token');
      await storage.delete(key: 'user_id');
      await storage.delete(key: 'name');
    }
  }

  Future<String?> getToken() async {
    return await storage.read(key: 'token');
  }

  Future<bool> isLoggedIn() async {
    final token = await getToken();
    return token != null;
  }
}
