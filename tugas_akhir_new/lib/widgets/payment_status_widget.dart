import 'package:flutter/material.dart';
import '../models/midtrans_payment.dart';
import '../services/payment_service.dart';

class PaymentStatusWidget extends StatelessWidget {
  final String orderId;
  final PaymentService paymentService;

  const PaymentStatusWidget({
    Key? key,
    required this.orderId,
    required this.paymentService,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return StreamBuilder<MidtransPayment>(
      stream: paymentService.watchPaymentStatus(orderId),
      builder: (context, snapshot) {
        if (snapshot.hasError) {
          return Card(
            color: Colors.red.shade100,
            child: Padding(
              padding: const EdgeInsets.all(16),
              child: Column(
                mainAxisSize: MainAxisSize.min,
                children: [
                  const Icon(Icons.error_outline, color: Colors.red, size: 48),
                  const SizedBox(height: 16),
                  Text(
                    'Error: ${snapshot.error}',
                    style: const TextStyle(color: Colors.red),
                    textAlign: TextAlign.center,
                  ),
                ],
              ),
            ),
          );
        }

        if (!snapshot.hasData) {
          return const Center(child: CircularProgressIndicator());
        }

        final payment = snapshot.data!;
        Color statusColor;
        IconData statusIcon;
        String statusText;

        if (payment.isSuccess) {
          statusColor = Colors.green;
          statusIcon = Icons.check_circle;
          statusText = 'Pembayaran Berhasil';
          Future.microtask(() => Navigator.of(context).pop({
                'status': 'success',
                'orderId': orderId,
              }));
        } else if (payment.isPending) {
          statusColor = Colors.orange;
          statusIcon = Icons.access_time;
          statusText = 'Menunggu Pembayaran';
        } else if (payment.isFailed) {
          statusColor = Colors.red;
          statusIcon = Icons.cancel;
          statusText = 'Pembayaran Gagal';
          Future.microtask(() => Navigator.of(context).pop({
                'status': 'failed',
                'orderId': orderId,
              }));
        } else {
          statusColor = Colors.grey;
          statusIcon = Icons.help;
          statusText = 'Status: ${payment.transactionStatus}';
        }

        return Card(
          child: Padding(
            padding: const EdgeInsets.all(16),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                Icon(statusIcon, color: statusColor, size: 48),
                const SizedBox(height: 16),
                Text(
                  statusText,
                  style: TextStyle(
                    color: statusColor,
                    fontSize: 18,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                const SizedBox(height: 8),
                if (payment.paymentType.isNotEmpty)
                  Text(
                    'Metode: ${payment.paymentType}',
                    style: const TextStyle(color: Colors.grey),
                  ),
                const SizedBox(height: 8),
                Text(
                  'Total: Rp ${payment.grossAmount}',
                  style: const TextStyle(fontSize: 16),
                ),
                if (payment.transactionTime.isNotEmpty) ...[
                  const SizedBox(height: 8),
                  Text(
                    'Waktu: ${payment.transactionTime}',
                    style: const TextStyle(color: Colors.grey),
                  ),
                ],
              ],
            ),
          ),
        );
      },
    );
  }
}
