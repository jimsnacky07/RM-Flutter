import 'dart:convert';
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'package:http/http.dart' as http;
import '../models/menu_model.dart';

class MenuService {
  static const String baseUrl =
      'http://192.168.100.48/skripsi-dian-pnp/backend_apk/public/api';
  final storage = const FlutterSecureStorage();

  Future<List<MenuItem>> getMenuItems() async {
    final response = await http.get(
      Uri.parse('$baseUrl/menus'),
      headers: {
        'Accept': 'application/json',
      },
    );

    print('URL: ${Uri.parse('$baseUrl/menus')}'); // Debug URL
    print('Response Status: ${response.statusCode}'); // Debug status code
    print('Response Body: ${response.body}'); // Debug response body

    if (response.statusCode == 200) {
      try {
        final Map<String, dynamic> responseData = jsonDecode(response.body);
        print('Parsed Response: $responseData'); // Debug parsed response

        if (responseData['success'] == true && responseData['data'] != null) {
          final List<dynamic> data = responseData['data'];
          final items = data.map((json) => MenuItem.fromJson(json)).toList();
          print('Parsed ${items.length} menu items'); // Debug item count
          return items;
        } else {
          throw Exception(
              'Invalid response format: success=${responseData['success']}, data=${responseData['data']}');
        }
      } catch (e) {
        print('Error parsing response: $e'); // Debug parsing error
        throw Exception('Failed to parse menu items: $e');
      }
    } else {
      throw Exception(
          'Failed to load menu items: ${response.statusCode}\nBody: ${response.body}');
    }
  }

  Future<MenuItem> getMenuDetail(int id) async {
    final response = await http.get(
      Uri.parse('$baseUrl/menus/$id'),
      headers: {
        'Accept': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      print('Response Detail: ${response.body}'); // Untuk debugging
      final Map<String, dynamic> responseData = jsonDecode(response.body);
      if (responseData['success'] == true && responseData['data'] != null) {
        return MenuItem.fromJson(responseData['data']);
      } else {
        throw Exception('Invalid response format');
      }
    } else {
      throw Exception('Failed to load menu detail: ${response.statusCode}');
    }
  }
}
