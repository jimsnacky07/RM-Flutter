@extends('layouts.operator')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-0 text-primary">
                <i class="fas fa-shopping-cart me-2"></i>Daftar Pesanan
            </h1>
            <p class="text-muted">Kelola semua pesanan dari pelanggan</p>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Orders Table Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i>Daftar Pesanan</h5>
        </div>
        <div class="card-body">
            @if($pesanans && $pesanans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>No</th>
                            <th><i class="fas fa-user me-2"></i>Nama Pemesan</th>
                            <th><i class="fas fa-money-bill me-2"></i>Total Harga</th>
                            <th><i class="fas fa-info-circle me-2"></i>Status</th>
                            <th><i class="fas fa-credit-card me-2"></i>Metode Pembayaran</th>
                            <th><i class="fas fa-calendar me-2"></i>Tanggal Pesanan</th>
                            <th class="text-center"><i class="fas fa-cogs me-2"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanans as $index => $pesanan)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">{{ $index + 1 }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-user text-primary"></i>
                                    </div>
                                    <span class="fw-medium">
                                        {{ $pesanan->user->name ?? $pesanan->nama_pelanggan ?? 'Pelanggan' }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-success fs-6">
                                    Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                @php
                                $statusColors = [
                                'pending' => 'warning',
                                'Dikonfirmasi' => 'primary',
                                'Diproses' => 'info',
                                'Selesai' => 'success',
                                'Dibatalkan' => 'danger',
                                ];

                                $statusIcons = [
                                'pending' => 'clock',
                                'Dikonfirmasi' => 'check-circle',
                                'Diproses' => 'cog',
                                'Selesai' => 'check-double',
                                'Dibatalkan' => 'times-circle',
                                ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$pesanan->status ?? 'pending'] ?? 'secondary' }}">
                                    <i class="fas fa-{{ $statusIcons[$pesanan->status ?? 'pending'] ?? 'question' }} me-1"></i>
                                    {{ $pesanan->status == 'pending' ? 'Menunggu Konfirmasi' : ($pesanan->status ?? 'Pending') }}
                                </span>
                            </td>
                            <td>
                                @if($pesanan->metode ?? $pesanan->metode_pembayaran)
                                <span class="badge bg-info">
                                    <i class="fas fa-credit-card me-1"></i>
                                    {{ $pesanan->metode ?? $pesanan->metode_pembayaran }}
                                </span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt text-muted me-2"></i>
                                    <span>{{ $pesanan->created_at->format('d-m-Y H:i') }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button type="button"
                                        class="btn btn-sm btn-outline-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateStatusModal{{ $pesanan->id }}"
                                        title="Update Status">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center text-muted py-5">
                <div class="py-4">
                    <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
                    <p class="h5 mb-2">Belum ada pesanan</p>
                    <p class="text-muted">Pesanan akan muncul di sini setelah pelanggan melakukan order</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

<!-- Modal Update Status untuk setiap pesanan -->
@foreach($pesanans as $pesanan)
<div class="modal fade" id="updateStatusModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="updateStatusModalLabel{{ $pesanan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStatusModalLabel{{ $pesanan->id }}">
                    <i class="fas fa-edit me-2"></i>Update Status Pesanan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('operator.pesanan.updateStatus', $pesanan->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status{{ $pesanan->id }}" class="form-label">Status Pesanan</label>
                        <select class="form-select" id="status{{ $pesanan->id }}" name="status" required>
                            <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                            <option value="Dikonfirmasi" {{ $pesanan->status == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                            <option value="Diproses" {{ $pesanan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Dibatalkan" {{ $pesanan->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Pesanan:</strong> {{ $pesanan->user->name ?? $pesanan->nama_pelanggan ?? 'Pelanggan' }}<br>
                        <strong>Total:</strong> Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach