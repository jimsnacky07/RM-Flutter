@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detail Pesanan #{{ $pesanan->id }}</h1>
    
    <!-- Informasi Pesanan -->
    <div class="card">
        <div class="card-header">
            <h3>Informasi Pesanan</h3>
        </div>
        <div class="card-body">
            <p><strong>Status:</strong> {{ $pesanan->status }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
            <p><strong>Tanggal Pesanan:</strong> {{ $pesanan->created_at->format('d-m-Y H:i') }}</p>
        </div>
    </div>

    <!-- Daftar Menu yang Dipesan -->
    <div class="card mt-4">
        <div class="card-header">
            <h3>Daftar Menu</h3>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($pesanan->detailPesanan as $detail)
                    <li class="list-group-item">
                        <strong>{{ $detail->menu->nama }}</strong>
                        <span class="float-right">Rp {{ number_format($detail->harga, 0, ',', '.') }} x {{ $detail->jumlah }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Tombol untuk Kembali -->
    <div class="mt-4">
        <a href="{{ route('admin.pesanan.index') }}" class="btn btn-primary">Kembali ke Daftar Pesanan</a>
    </div>
</div>
@endsection