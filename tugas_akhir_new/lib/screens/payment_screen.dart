import 'package:flutter/material.dart';
import 'package:flutter_inappwebview/flutter_inappwebview.dart';
import '../services/payment_service.dart';
import '../widgets/payment_status_widget.dart';

class PaymentScreen extends StatefulWidget {
  final String snapToken;
  final String orderId;
  final PaymentService paymentService;

  const PaymentScreen({
    Key? key,
    required this.snapToken,
    required this.orderId,
    required this.paymentService,
  }) : super(key: key);

  @override
  State<PaymentScreen> createState() => _PaymentScreenState();
}

class _PaymentScreenState extends State<PaymentScreen> {
  late InAppWebViewController _webViewController;
  bool isLoading = true;

  @override
  void initState() {
    super.initState();

    // Listen payment status, auto-close jika success/failed
    widget.paymentService.watchPaymentStatus(widget.orderId).listen((status) {
      if (status.isSuccess || status.isFailed) {
        if (mounted) {
          Navigator.of(context).pop({
            'status': status.isSuccess ? 'success' : 'failed',
            'orderId': widget.orderId,
          });
        }
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    final snapUrl =
        'https://app.sandbox.midtrans.com/snap/v2/vtweb/${widget.snapToken}';

    return Scaffold(
      appBar: AppBar(
        title: const Text('Pembayaran'),
        leading: IconButton(
          icon: const Icon(Icons.close),
          onPressed: () => Navigator.of(context).pop({'status': 'cancelled'}),
        ),
      ),
      body: Stack(
        children: [
          InAppWebView(
            initialUrlRequest: URLRequest(url: WebUri(snapUrl)),
            initialOptions: InAppWebViewGroupOptions(
              crossPlatform: InAppWebViewOptions(
                javaScriptEnabled: true,
                useShouldOverrideUrlLoading: true,
                mediaPlaybackRequiresUserGesture: false,
                clearCache: true,
              ),
              android: AndroidInAppWebViewOptions(
                safeBrowsingEnabled: true,
              ),
            ),
            onWebViewCreated: (controller) {
              _webViewController = controller;
            },
            onLoadStop: (controller, url) {
              setState(() => isLoading = false);
            },
            shouldOverrideUrlLoading: (controller, navigationAction) async {
              // Bisa tambahkan logika auto-close via URL
              return NavigationActionPolicy.ALLOW;
            },
            onReceivedServerTrustAuthRequest: (controller, challenge) async {
              // Ambil host dari URL
              final host = challenge.protectionSpace.host;

              // Bypass SSL hanya untuk sandbox ngrok
              if (host.contains('https://3eacf925b59e.ngrok-free.app')) {
                return ServerTrustAuthResponse(
                    action: ServerTrustAuthResponseAction.PROCEED);
              } else {
                return ServerTrustAuthResponse(
                    action: ServerTrustAuthResponseAction.CANCEL);
              }
            },
          ),
          if (isLoading) const Center(child: CircularProgressIndicator()),
        ],
      ),
      // bottomSheet: PaymentStatusWidget(
      //   orderId: widget.orderId,
      //   paymentService: widget.paymentService,
      // ),
    );
  }
}
