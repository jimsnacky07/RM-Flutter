@extends('layouts.admin')

@section('title', 'Laporan Bulanan')

@section('content')
    <div class="container-fluid">
        <!-- Header & Back Button -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-primary">
                    <i class="fas fa-chart-bar me-2"></i>Laporan Bulanan
                </h1>
                <p class="text-muted">Laporan penjualan dan pendapatan bulanan</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Laporan</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.laporan.bulanan') }}" class="row g-3">
                            <div class="col-md-6">
                                <label for="bulan" class="form-label fw-medium">
                                    <i class="fas fa-calendar me-2"></i>Bulan
                                </label>
                                <select id="bulan" name="bulan" class="form-select" required>
                                    <option value="">Pilih Bulan</option>
                                    <option value="01" {{ request('bulan') == '01' ? 'selected' : '' }}>Januari</option>
                                    <option value="02" {{ request('bulan') == '02' ? 'selected' : '' }}>Februari
                                    </option>
                                    <option value="03" {{ request('bulan') == '03' ? 'selected' : '' }}>Maret</option>
                                    <option value="04" {{ request('bulan') == '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ request('bulan') == '05' ? 'selected' : '' }}>Mei</option>
                                    <option value="06" {{ request('bulan') == '06' ? 'selected' : '' }}>Juni</option>
                                    <option value="07" {{ request('bulan') == '07' ? 'selected' : '' }}>Juli</option>
                                    <option value="08" {{ request('bulan') == '08' ? 'selected' : '' }}>Agustus</option>
                                    <option value="09" {{ request('bulan') == '09' ? 'selected' : '' }}>September
                                    </option>
                                    <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober
                                    </option>
                                    <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November
                                    </option>
                                    <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tahun" class="form-label fw-medium">
                                    <i class="fas fa-calendar-alt me-2"></i>Tahun
                                </label>
                                <select id="tahun" name="tahun" class="form-select" required>
                                    <option value="">Pilih Tahun</option>
                                    @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                                        <option value="{{ $year }}"
                                            {{ request('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search me-2"></i>Tampilkan Laporan
                                </button>
                                <a href="{{ route('admin.laporan.bulanan') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-refresh me-2"></i>Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Ringkasan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="bg-primary bg-opacity-10 rounded p-3">
                                    <h4 class="text-primary fw-bold">{{ $totalPesanan ?? 0 }}</h4>
                                    <p class="text-muted mb-0">Total Pesanan</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-success bg-opacity-10 rounded p-3">
                                    <h4 class="text-success fw-bold">Rp
                                        {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h4>
                                    <p class="text-muted mb-0">Total Pendapatan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Laporan Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-table me-2"></i>
                            Laporan Bulanan
                            @if (request('bulan') && request('tahun'))
                                -
                                {{ \Carbon\Carbon::createFromDate(request('tahun'), request('bulan'), 1)->format('F Y') }}
                            @endif
                        </h5>
                        @if (isset($pesanans) && $pesanans->count() > 0)
                            <button class="btn btn-success btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-download me-2"></i>Export Excel
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        @if (isset($pesanans) && $pesanans->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover" id="laporanTable">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-hashtag me-2"></i>No</th>
                                            <th><i class="fas fa-calendar me-2"></i>Tanggal</th>
                                            <th><i class="fas fa-user me-2"></i>Pelanggan</th>
                                            <th><i class="fas fa-utensils me-2"></i>Menu</th>
                                            <th><i class="fas fa-money-bill me-2"></i>Total Harga</th>
                                            <th><i class="fas fa-info-circle me-2"></i>Status</th>
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
                                                        <i class="fas fa-calendar-alt text-muted me-2"></i>
                                                        <span>{{ $pesanan->created_at->format('d-m-Y H:i') }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="fas fa-user text-primary"></i>
                                                        </div>
                                                        <span class="fw-medium">
                                                            {{ $pesanan->user->nama ?? ($pesanan->nama_pelanggan ?? 'Pelanggan') }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($pesanan->detailPesanan && $pesanan->detailPesanan->count() > 0)
                                                        @foreach ($pesanan->detailPesanan as $detail)
                                                            <div class="d-flex align-items-center mb-1">
                                                                <div
                                                                    class="bg-success bg-opacity-10 rounded-circle p-1 me-2">
                                                                    <i class="fas fa-utensils text-success fa-sm"></i>
                                                                </div>
                                                                <span class="fw-medium">
                                                                    {{ $detail->menu->nama ?? 'Menu' }}
                                                                    <span
                                                                        class="badge bg-info">{{ $detail->jumlah ?? 1 }}</span>
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-success fs-6">
                                                        Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}
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

                                                        $status = $pesanan->status ?? 'pending';
                                                    @endphp
                                                    <span class="badge bg-{{ $statusColors[$status] ?? 'secondary' }}">
                                                        <i
                                                            class="fas fa-{{ $statusIcons[$status] ?? 'question' }} me-1"></i>
                                                        {{ ucfirst($status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center text-muted py-5">
                                <div class="py-4">
                                    <i class="fas fa-chart-bar fa-3x mb-3 text-muted"></i>
                                    <p class="h5 mb-2">Belum ada data laporan</p>
                                    <p class="text-muted">
                                        @if (request('bulan') && request('tahun'))
                                            Pilih bulan dan tahun yang berbeda atau belum ada transaksi pada periode
                                            tersebut
                                        @else
                                            Pilih bulan dan tahun untuk melihat laporan
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function exportToExcel() {
                const table = document.getElementById('laporanTable');
                if (!table) return;

                const rows = Array.from(table.querySelectorAll('tr'));

                let csv = [];
                rows.forEach(row => {
                    const cols = Array.from(row.querySelectorAll('td, th'));
                    const rowData = cols.map(col => {
                        // Remove HTML tags and get clean text
                        return col.textContent.replace(/\s+/g, ' ').trim();
                    });
                    csv.push(rowData.join(','));
                });

                const csvContent = csv.join('\n');
                const blob = new Blob([csvContent], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement('a');
                const url = URL.createObjectURL(blob);
                link.setAttribute('href', url);
                link.setAttribute('download',
                    'laporan_bulanan_{{ request('bulan') ?? '' }}_{{ request('tahun') ?? '' }}.csv');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        </script>
    @endpush
@endsection
