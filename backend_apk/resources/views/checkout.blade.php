<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <style>
        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #0d6efd;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }

        @keyframes spin { 100% { transform: rotate(360deg); } }

        .result-box {
            display: none;
            transition: all 0.3s ease;
        }
        .result-box.show {
            display: block;
        }
        .result-icon {
            font-size: 40px;
            margin-right: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <h3 class="card-title mb-3">Pesanan #{{ $pesananId }}</h3>
            <p class="card-text mb-4">Total Harga: <strong>Rp <span id="total-harga">...</span></strong></p>

            <div id="loader" class="loader"></div>
            <button id="pay-button" class="btn btn-primary btn-lg" style="display:none;">Bayar Sekarang</button>

            <div id="payment-result" class="result-box alert mt-4 d-flex align-items-center"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/create-transaction/{{ $pesananId }}')
    .then(res => res.json())
    .then(data => {
        document.getElementById('loader').style.display = 'none';
        if(data.success) {
            document.getElementById('total-harga').innerText = data.total_harga ?? '0';
            const snapToken = data.snap_token;
            const payButton = document.getElementById('pay-button');
            payButton.style.display = 'inline-block';

            payButton.addEventListener('click', function () {
                window.snap.pay(snapToken, {
                    onSuccess: function(result){
                        showResult('success', '✓ Pembayaran berhasil!');
                        console.log(result);
                    },
                    onPending: function(result){
                        showResult('warning', '⏳ Pembayaran pending!');
                        console.log(result);
                    },
                    onError: function(result){
                        showResult('danger', '✗ Pembayaran gagal!');
                        console.log(result);
                    },
                    onClose: function(){
                        showResult('secondary', '⚠️ Popup ditutup.');
                    }
                });
            });

        } else {
            showResult('danger', 'Gagal membuat transaksi');
        }
    })
    .catch(err => showResult('danger', 'Gagal terhubung ke server'));

    function showResult(type, message) {
        const container = document.getElementById('payment-result');
        container.className = `result-box alert alert-${type} mt-4 d-flex align-items-center show`;
        container.innerHTML = `<span class="result-icon">${message.split(' ')[0]}</span><span>${message.replace(/^.\s/, '')}</span>`;
    }
});
</script>
</body>
</html>
