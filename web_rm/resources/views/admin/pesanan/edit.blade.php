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
                <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $pesanan->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ $pesanan->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="total">Total Harga</label>
            <input type="text" name="total" class="form-control" id="total" value="{{ $pesanan->total }}" readonly>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update Pesanan</button>
    </form>
</div>
@endsection
