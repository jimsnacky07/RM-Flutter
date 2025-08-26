@extends('layouts.admin')

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
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
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
                @if ($pesanans->count() > 0)
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
                                @foreach ($pesanans as $index => $pesanan)
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
                                                    {{ $pesanan->user->name ?? ($pesanan->nama_pelanggan ?? 'Pelanggan') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success fs-6">
                                                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'Menunggu Pembayaran' => 'warning',
                                                    'Dikirim' => 'success',
                                                    'Diproses' => 'info',
                                                    'Selesai' => 'success',
                                                    'Dibatalkan' => 'danger',
                                                ];

                                                $statusIcons = [
                                                    'Menunggu Pembayaran' => 'clock',
                                                    'Dikirim' => 'check-circle',
                                                    'Diproses' => 'cog',
                                                    'Selesai' => 'check-double',
                                                    'Dibatalkan' => 'times-circle',
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$pesanan->status] ?? 'secondary' }}">
                                                <i
                                                    class="fas fa-{{ $statusIcons[$pesanan->status] ?? 'question' }} me-1"></i>
                                                {{ $pesanan->status == 'Menunggu Pembayaran' ? 'Menunggu Konfirmasi' : $pesanan->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($pesanan->metode ?? $pesanan->metode_pembayaran)
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
                                                <a href="{{ route('admin.pesanan.show', $pesanan->id) }}"
                                                    class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip"
                                                    title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}"
                                                    class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip"
                                                    title="Edit Pesanan">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pesanan->id }}"
                                                    title="Hapus Pesanan">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $pesanan->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger">
                                                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
                                                    <p class="text-muted small">Tindakan ini tidak dapat dibatalkan.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-2"></i>Batal
                                                    </button>
                                                    <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash me-2"></i>Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
