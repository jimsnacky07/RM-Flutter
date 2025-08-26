@extends('layouts.operator')

@section('title', 'Dashboard Operator')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-4">
                    <h1 class="display-6 fw-bold text-primary mb-2">
                        <i class="fas fa-user-cog me-3"></i>Selamat Datang, Operator!
                    </h1>
                    <p class="lead text-muted">Kelola pesanan dan menu rumah makan dengan mudah</p>
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
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-utensils fa-2x text-success"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-success">{{ $totalMenu ?? '0' }}</h3>
                    <p class="text-muted mb-0">Total Menu</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-shopping-cart fa-2x text-primary"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $totalPesanan ?? '0' }}</h3>
                    <p class="text-muted mb-0">Total Pesanan</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-calendar-day fa-2x text-info"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-info">{{ $pesananHariIni ?? '0' }}</h3>
                    <p class="text-muted mb-0">Pesanan Hari Ini</p>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-warning">{{ $pesananMenunggu ?? '0' }}</h3>
                    <p class="text-muted mb-0">Menunggu Konfirmasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Card -->
    <div class="row mb-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-money-bill-wave me-2"></i>Pendapatan Hari Ini</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="display-6 fw-bold text-success">
                        Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}
                    </h2>
                    <p class="text-muted mb-0">Total pendapatan hari ini</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('operator.pesanan.index') }}" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="fas fa-eye me-2"></i>Lihat Pesanan Masuk
                        @if($pesananMenunggu > 0)
                        <span class="badge bg-danger ms-2">{{ $pesananMenunggu }}</span>
                        @endif
                    </a>
                    <a href="{{ route('operator.menus.index') }}" class="btn btn-outline-success w-100">
                        <i class="fas fa-utensils me-2"></i>Lihat Menu
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-2"></i>No</th>
                                    <th><i class="fas fa-calendar me-2"></i>Waktu</th>
                                    <th><i class="fas fa-utensils me-2"></i>Menu</th>
                                    <th><i class="fas fa-money-bill me-2"></i>Total</th>
                                    <th><i class="fas fa-info-circle me-2"></i>Status</th>
                                    <th class="text-center"><i class="fas fa-cogs me-2"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesananTerbaru ?? [] as $index => $p)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-muted me-2"></i>
                                            <span>{{ $p->created_at->format('d-m-Y H:i') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($p->detailPesanan ?? [] as $detail)
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-1 me-2">
                                                <i class="fas fa-utensils text-success fa-sm"></i>
                                            </div>
                                            <span class="fw-medium">
                                                {{ $detail->menu->nama ?? 'Menu' }}
                                                <span class="badge bg-info">{{ $detail->jumlah }}</span>
                                            </span>
                                        </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span class="badge bg-success fs-6">
                                            Rp {{ number_format($p->total_harga ?? 0, 0, ',', '.') }}
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
                                        <span class="badge bg-{{ $statusColors[$p->status ?? 'pending'] ?? 'secondary' }}">
                                            <i class="fas fa-{{ $statusIcons[$p->status ?? 'pending'] ?? 'question' }} me-1"></i>
                                            {{ $p->status ?? 'Pending' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-muted">-</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                            <p class="h5 mb-2">Belum ada pesanan</p>
                                            <p class="text-muted">Pesanan akan muncul di sini setelah pelanggan melakukan order</p>
                                        </div>
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