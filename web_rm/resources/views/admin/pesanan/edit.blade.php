@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Pesanan #{{ $pesanan->id }}</h1>

        <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Status Pesanan</label>
                <select name="status" class="form-control" id="status">
                    <option value="{{ $pesanan->status }}" {{ $pesanan->status == 'Diproses' ? 'selected' : '' }}>
                        {{ $pesanan->status }}
                    </option>
                    <option value="Dikirim" {{ $pesanan->status == 'Dikirim' ? 'selected' : '' }}>
                        Dikirim</option>
                    <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>
                        Selesai</option>
                    <option value="Menunggu Pembayaran" {{ $pesanan->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>
                        Menunggu Pembayaran</option>
                    <option value="Dibatalkan" {{ $pesanan->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="total">Total Harga</label>
                <input type="text" name="total" class="form-control" id="total" value="{{ $pesanan->total_harga }}"
                    readonly>
            </div>

            <button type="submit" class="btn btn-success mt-3">Update Pesanan</button>
        </form>
    </div>
@endsection
