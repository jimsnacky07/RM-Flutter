class Order {
  final int id;
  final int userId;
  final String orderId;
  final double totalHarga;
  final String status;
  final String metodePembayaran;
  final String? snapToken;
  final List<OrderItem> items;
  final DateTime createdAt;

  Order({
    required this.id,
    required this.userId,
    required this.orderId,
    required this.totalHarga,
    required this.status,
    required this.metodePembayaran,
    this.snapToken,
    required this.items,
    required this.createdAt,
  });

  factory Order.fromJson(Map<String, dynamic> json) {
    var itemsList = json['items'] as List;
    List<OrderItem> orderItems =
        itemsList.map((item) => OrderItem.fromJson(item)).toList();

    return Order(
      id: json['id'],
      userId: json['user_id'],
      orderId: json['order_id'],
      totalHarga: double.parse(json['total_harga'].toString()),
      status: json['status'],
      metodePembayaran: json['metode_pembayaran'],
      snapToken: json['snap_token'],
      items: orderItems,
      createdAt: DateTime.parse(json['created_at']),
    );
  }
}

class OrderItem {
  final int menuId;
  final int quantity;
  final double harga;
  final double subtotal;
  final String? notes;

  OrderItem({
    required this.menuId,
    required this.quantity,
    required this.harga,
    required this.subtotal,
    this.notes,
  });

  factory OrderItem.fromJson(Map<String, dynamic> json) {
    return OrderItem(
      menuId: json['menu_id'],
      quantity: json['quantity'],
      harga: double.parse(json['harga'].toString()),
      subtotal: double.parse(json['subtotal'].toString()),
      notes: json['notes'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'menu_id': menuId,
      'quantity': quantity,
      'notes': notes,
    };
  }
}
