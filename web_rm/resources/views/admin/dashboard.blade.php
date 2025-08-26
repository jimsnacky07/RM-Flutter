@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <h1 class="display-4 fw-bold text-primary mb-3">
                        <i class="fas fa-tachometer-alt me-3"></i>Selamat Datang!
                    </h1>
                    <p class="lead text-muted">Halo, {{ Auth::user()->nama ?? 'Admin' }}! Selamat datang di Dashboard Admin</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $totalPengguna ?? '0' }}</h3>
                    <p class="text-muted mb-0">Total Pengguna</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-utensils fa-2x text-success"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-success">{{ $menuTerbaru ?? '0' }}</h3>
                    <p class="text-muted mb-0">Menu Terbaru</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-shopping-cart fa-2x text-warning"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $totalPesanan ?? '0' }}</h3>
                    <p class="text-muted mb-0">Total Pesanan</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-money-bill-wave fa-2x text-info"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-info">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0">Total Pendapatan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Menu Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.pengguna.index') }}" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <span>Kelola Pengguna</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-utensils fa-2x mb-2"></i>
                                <span>Kelola Menu</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                                <span>Lihat Pesanan</span>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.laporan.bulanan') }}" class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-chart-bar fa-2x mb-2"></i>
                                <span>Laporan Bulanan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Laporan Penjualan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-2"></i>ID</th>
                                    <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                                    <th><i class="fas fa-money-bill me-2"></i>Total Harga</th>
                                    <th><i class="fas fa-cogs me-2"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(($orders ?? []) as $order)
                                <tr>
                                    <td><span class="badge bg-primary">#{{ $order->id }}</span></td>
                                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    <td><span class="fw-bold text-success">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span></td>
                                    <td>
                                        <a href="{{ route('admin.pesanan.show', $order->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-3x mb-3"></i>
                                        <p class="mb-0">Belum ada data pesanan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection