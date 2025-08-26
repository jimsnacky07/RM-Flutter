<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Scan QR Meja</title>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <style>
    body {
      font-family: sans-serif;
      text-align: center;
      margin-top: 40px;
    }
    #reader {
      width: 300px;
      margin: auto;
    }
  </style>
</head>
<body>
  <h2>Scan QR Code untuk Memesan</h2>
  <div id="reader"></div>
  <p id="result"></p>

  <script>
    function onScanSuccess(qrMessage) {
        // Contoh isi QR: http://localhost:8000/pesan?meja=5
        document.getElementById('result').innerText = `Menuju ke: ${qrMessage}`;
        window.location.href = qrMessage;
    }

    function onScanError(errorMessage) {
        console.warn(errorMessage);
    }

    const html5QrCode = new Html5Qrcode("reader");
    const config = { fps: 10, qrbox: 250 };

    Html5Qrcode.getCameras().then(devices => {
      if (devices && devices.length) {
        html5QrCode.start(devices[0].id, config, onScanSuccess, onScanError);
      }
    }).catch(err => {
      console.error(err);
    });
  </script>
</body>
</html>
