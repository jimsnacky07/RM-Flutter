import 'package:flutter/material.dart';

class PaymentMethodSelector extends StatelessWidget {
  final String selectedMethod;
  final Function(String) onMethodSelected;

  const PaymentMethodSelector({
    Key? key,
    required this.selectedMethod,
    required this.onMethodSelected,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        const Padding(
          padding: EdgeInsets.symmetric(horizontal: 16.0, vertical: 8.0),
          child: Text(
            'Pilih Metode Pembayaran',
            style: TextStyle(
              fontSize: 16,
              fontWeight: FontWeight.bold,
            ),
          ),
        ),
        Card(
          margin: const EdgeInsets.symmetric(horizontal: 16.0),
          child: Column(
            children: [
              _buildPaymentOption(
                context: context,
                title: 'Bank Transfer',
                subtitle: 'BCA, Mandiri, BNI, BRI',
                icon: 'assets/bank.png',
                value: 'bank_transfer',
              ),
              const Divider(height: 1),
              _buildPaymentOption(
                context: context,
                title: 'E-Wallet',
                subtitle: 'DANA, GoPay, OVO, LinkAja',
                icon: 'assets/ewallet.png',
                value: 'e_wallet',
              ),
              const Divider(height: 1),
              _buildPaymentOption(
                context: context,
                title: 'Cash on Delivery',
                subtitle: 'Bayar saat pesanan tiba',
                icon: 'assets/cod.png',
                value: 'cod',
              ),
            ],
          ),
        ),
      ],
    );
  }

  Widget _buildPaymentOption({
    required BuildContext context,
    required String title,
    required String subtitle,
    required String icon,
    required String value,
  }) {
    final isSelected = selectedMethod == value;

    return InkWell(
      onTap: () => onMethodSelected(value),
      child: Container(
        padding: const EdgeInsets.all(16.0),
        color: isSelected ? Colors.green.withOpacity(0.1) : null,
        child: Row(
          children: [
            Container(
              width: 40,
              height: 40,
              decoration: BoxDecoration(
                color: isSelected
                    ? Colors.green.withOpacity(0.1)
                    : Colors.grey.withOpacity(0.1),
                borderRadius: BorderRadius.circular(8),
              ),
              child: Icon(
                value == 'bank_transfer'
                    ? Icons.account_balance
                    : value == 'e_wallet'
                        ? Icons.account_balance_wallet
                        : Icons.local_shipping,
                color: isSelected ? Colors.green : Colors.grey[600],
                size: 24,
              ),
            ),
            const SizedBox(width: 16),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Text(
                    title,
                    style: const TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                  Text(
                    subtitle,
                    style: Theme.of(context).textTheme.bodySmall,
                  ),
                ],
              ),
            ),
            if (isSelected)
              const Icon(
                Icons.check_circle,
                color: Colors.green,
              ),
          ],
        ),
      ),
    );
  }
}
