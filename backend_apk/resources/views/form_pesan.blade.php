<!DOCTYPE html>
<html>
<head>
  <title>Pemesanan</title>
</head>
<body>
  <h2>Pesan Menu (Meja {{ $nomorMeja }})</h2>

  @if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
  @endif

  <form method="POST" action="/pesan">
    @csrf
    <input type="hidden" name="nomor_meja" value="{{ $nomorMeja }}">

    @foreach ($menus as $menu)
      <div style="margin-bottom: 10px;">
        <label>
          <input type="checkbox" name="menu_id[]" value="{{ $menu->id }}">
          {{ $menu->nama_menu }} - Rp{{ $menu->harga }}
        </label>
        <input type="number" name="jumlah[{{ $menu->id }}]" min="1" value="1">
      </div>
    @endforeach

    <button type="submit">Pesan Sekarang</button>
  </form>
</body>
</html>
