import 'package:flutter/material.dart';
import 'package:webview_flutter/webview_flutter.dart';

class PaymentWebView extends StatefulWidget {
  final String paymentUrl;
  final String orderId;

  const PaymentWebView({
    Key? key,
    required this.paymentUrl,
    required this.orderId,
  }) : super(key: key);

  @override
  State<PaymentWebView> createState() => _PaymentWebViewState();
}

class _PaymentWebViewState extends State<PaymentWebView> {
  late final WebViewController controller;

  @override
  void initState() {
    super.initState();
    controller = WebViewController()
      ..setJavaScriptMode(JavaScriptMode.unrestricted)
      ..setBackgroundColor(const Color(0x00000000))
      ..setNavigationDelegate(
        NavigationDelegate(
          onNavigationRequest: (NavigationRequest request) {
            if (request.url.contains('payment_status=success')) {
              Navigator.of(context).pop('success');
              return NavigationDecision.prevent;
            }
            if (request.url.contains('payment_status=failed')) {
              Navigator.of(context).pop('failed');
              return NavigationDecision.prevent;
            }
            if (request.url.contains('transaction_status=settlement') ||
                request.url.contains('transaction_status=capture')) {
              Navigator.of(context).pop('success');
              return NavigationDecision.prevent;
            }
            if (request.url.contains('transaction_status=deny') ||
                request.url.contains('transaction_status=cancel') ||
                request.url.contains('transaction_status=expire')) {
              Navigator.of(context).pop('failed');
              return NavigationDecision.prevent;
            }
            return NavigationDecision.navigate;
          },
        ),
      )
      ..loadRequest(Uri.parse(widget.paymentUrl));
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Pembayaran'),
        leading: IconButton(
          icon: const Icon(Icons.close),
          onPressed: () => Navigator.of(context).pop('cancel'),
        ),
      ),
      body: WebViewWidget(controller: controller),
    );
  }
}
