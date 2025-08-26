import 'package:flutter/material.dart';
import 'package:webview_flutter/webview_flutter.dart';

class SnapPaymentScreen extends StatefulWidget {
  final String snapToken;

  const SnapPaymentScreen({
    Key? key,
    required this.snapToken,
  }) : super(key: key);

  @override
  State<SnapPaymentScreen> createState() => _SnapPaymentScreenState();
}

class _SnapPaymentScreenState extends State<SnapPaymentScreen> {
  late final WebViewController controller;
  bool isLoading = true;

  @override
  void initState() {
    super.initState();

    controller = WebViewController()
      ..setJavaScriptMode(JavaScriptMode.unrestricted)
      ..setNavigationDelegate(
        NavigationDelegate(
          onPageFinished: (String url) {
            setState(() {
              isLoading = false;
            });
          },
          onNavigationRequest: (NavigationRequest request) {
            if (request.url.contains('payment_status=success')) {
              Navigator.of(context).pop('success');
              return NavigationDecision.prevent;
            }
            if (request.url.contains('payment_status=failed')) {
              Navigator.of(context).pop('failed');
              return NavigationDecision.prevent;
            }
            return NavigationDecision.navigate;
          },
        ),
      )
      ..loadRequest(
        Uri.parse(
          'https://app.sandbox.midtrans.com/snap/v2/vtweb/${widget.snapToken}',
        ),
      );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Pembayaran'),
        leading: IconButton(
          icon: const Icon(Icons.close),
          onPressed: () => Navigator.of(context).pop(),
        ),
      ),
      body: Stack(
        children: [
          WebViewWidget(controller: controller),
          if (isLoading)
            const Center(
              child: CircularProgressIndicator(),
            ),
        ],
      ),
    );
  }
}
