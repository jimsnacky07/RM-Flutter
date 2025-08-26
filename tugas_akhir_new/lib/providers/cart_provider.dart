import 'package:flutter/foundation.dart';
import '../models/cart_model.dart';
import '../models/menu_model.dart';

class CartProvider with ChangeNotifier {
  final Map<int, CartItem> _cartItems = {};

  Map<int, CartItem> get cartItems => _cartItems;

  void addToCart(MenuItem menuItem) {
    if (_cartItems.containsKey(menuItem.id)) {
      _cartItems[menuItem.id] = _cartItems[menuItem.id]!.copyWith(
        quantity: _cartItems[menuItem.id]!.quantity + 1,
      );
    } else {
      _cartItems[menuItem.id] = CartItem(
        id: menuItem.id,
        name: menuItem.name,
        imageUrl: menuItem.imageUrl,
        price: menuItem.price,
        quantity: 1,
      );
    }
    notifyListeners();
  }

  void removeFromCart(int id) {
    if (_cartItems.containsKey(id)) {
      final currentQuantity = _cartItems[id]!.quantity;
      if (currentQuantity > 1) {
        _cartItems[id] =
            _cartItems[id]!.copyWith(quantity: currentQuantity - 1);
      } else {
        _cartItems.remove(id);
      }
      notifyListeners();
    }
  }

  void updateQuantity(int id, int newQuantity) {
    if (_cartItems.containsKey(id) && newQuantity > 0) {
      _cartItems[id] = _cartItems[id]!.copyWith(quantity: newQuantity);
      notifyListeners();
    }
  }

  void clearCart() {
    _cartItems.clear();
    notifyListeners();
  }

  int get itemCount =>
      _cartItems.values.fold(0, (sum, item) => sum + item.quantity);

  double get totalPrice =>
      _cartItems.values.fold(0, (sum, item) => sum + item.totalPrice);
}
