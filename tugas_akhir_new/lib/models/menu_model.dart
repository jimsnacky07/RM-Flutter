class MenuItem {
  final int id;
  final String name;
  final String description;
  final double price;
  final String imageUrl;
  final bool isAvailable;

  MenuItem({
    required this.id,
    required this.name,
    required this.description,
    required this.price,
    required this.imageUrl,
    this.isAvailable = true,
  });

  factory MenuItem.fromJson(Map<String, dynamic> json) {
    return MenuItem(
      id: json['id'],
      name: json['nama'],
      description: json['deskripsi'] ?? '',
      price: double.parse(json['harga'].toString()),
      imageUrl:
          json['gambar']?.toString().replaceAll('assets/menus/', '') ?? '',
      isAvailable: json['is_available'] ?? true,
    );
  }
}
