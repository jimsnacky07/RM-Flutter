@extends('layouts.admin')

@section('title', 'Laporan Tahunan')

@section('content')
    <div class="container-fluid">
        <!-- Header & Back Button -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-primary">
                    <i class="fas fa-chart-line me-2"></i>Laporan Tahunan
                </h1>
                <p class="text-muted">Laporan penjualan dan pendapatan tahunan</p>
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
                        <form method="GET" action="{{ route('admin.laporan.tahunan') }}" class="row g-3">
                            <div class="col-md-8">
                                <label for="tahun" class="form-label fw-medium">
                                    <i class="fas fa-calendar-alt me-2"></i>Tahun
                                </label>
                                <select id="tahun" name="tahun" class="form-select" required>
                                    <option value="">Pilih Tahun</option>
                                    @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                        <option value="{{ $year }}"
                                            {{ request('tahun') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search me-2"></i>Tampilkan
                                    </button>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="{{ route('admin.laporan.tahunan') }}" class="btn btn-outline-secondary">
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
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Ringkasan Tahunan</h5>
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

        <!-- Chart Card -->
        @if (isset($laporanBulanan) && count($laporanBulanan) > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-area me-2"></i>
                                Grafik Pendapatan Bulanan {{ request('tahun') ?? date('Y') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="pendapatanChart" height="100"
                                data-labels="{{ json_encode($laporanBulanan->map(function ($item) {return \Carbon\Carbon::createFromDate(null, $item->bulan, 1)->format('M');})) }}"
                                data-values="{{ json_encode($laporanBulanan->pluck('total_pendapatan')) }}">
                            </canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Laporan Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-table me-2"></i>
                            Laporan Tahunan {{ request('tahun') ?? date('Y') }}
                        </h5>
                        @if (isset($laporanBulanan) && count($laporanBulanan) > 0)
                            <button class="btn btn-success btn-sm" onclick="exportToExcel()">
                                <i class="fas fa-download me-2"></i>Export Excel
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        @if (isset($laporanBulanan) && count($laporanBulanan) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover" id="laporanTable">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-calendar me-2"></i>Bulan</th>
                                            <th><i class="fas fa-shopping-cart me-2"></i>Total Pesanan</th>
                                            <th><i class="fas fa-money-bill me-2"></i>Total Pendapatan</th>
                                            <th><i class="fas fa-chart-line me-2"></i>Trend</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporanBulanan as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="fas fa-calendar text-primary"></i>
                                                        </div>
                                                        @php
                                                            $bulanIndo = [
                                                                1 => 'Januari',
                                                                2 => 'Februari',
                                                                3 => 'Maret',
                                                                4 => 'April',
                                                                5 => 'Mei',
                                                                6 => 'Juni',
                                                                7 => 'Juli',
                                                                8 => 'Agustus',
                                                                9 => 'September',
                                                                10 => 'Oktober',
                                                                11 => 'November',
                                                                12 => 'Desember',
                                                            ];
                                                        @endphp
                                                        <span class="fw-medium">
                                                            {{ $bulanIndo[$item->bulan] ?? '-' }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info fs-6">{{ $item->total_pesanan ?? 0 }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success fs-6">
                                                        Rp {{ number_format($item->total_pendapatan ?? 0, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @php
                                                        $trend = $item->trend ?? 'stable';
                                                        $trendColors = [
                                                            'up' => 'success',
                                                            'down' => 'danger',
                                                            'stable' => 'secondary',
                                                        ];
                                                        $trendIcons = [
                                                            'up' => 'fa-arrow-up',
                                                            'down' => 'fa-arrow-down',
                                                            'stable' => 'fa-minus',
                                                        ];
                                                        $trendTexts = [
                                                            'up' => 'Naik',
                                                            'down' => 'Turun',
                                                            'stable' => 'Stabil',
                                                        ];
                                                    @endphp
                                                    <span class="badge bg-{{ $trendColors[$trend] }}">
                                                        <i class="fas {{ $trendIcons[$trend] }} me-1"></i>
                                                        {{ $trendTexts[$trend] }}
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
                                    <i class="fas fa-chart-line fa-3x mb-3 text-muted"></i>
                                    <p class="h5 mb-2">Belum ada data laporan</p>
                                    <p class="text-muted">
                                        @if (request('tahun'))
                                            Pilih tahun yang berbeda atau belum ada transaksi pada tahun tersebut
                                        @else
                                            Pilih tahun untuk melihat laporan
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
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Chart initialization
            document.addEventListener('DOMContentLoaded', function() {
                const canvas = document.getElementById('pendapatanChart');
                if (!canvas) return;

                // Get data from data attributes
                const labels = JSON.parse(canvas.dataset.labels || '[]');
                const values = JSON.parse(canvas.dataset.values || '[]');

                if (labels.length === 0 || values.length === 0) return;

                const chartConfig = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pendapatan Bulanan (Rp)',
                            data: values,
                            backgroundColor: 'rgba(102, 126, 234, 0.2)',
                            borderColor: 'rgba(102, 126, 234, 1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: 'rgba(102, 126, 234, 1)',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        }
                    }
                };

                new Chart(canvas, chartConfig);
            });

            // Export functionality
            function exportToExcel() {
                const table = document.getElementById('laporanTable');
                if (!table) return;

                const rows = Array.from(table.querySelectorAll('tr'));

                let csv = [];
                rows.forEach(row => {
                    const cols = Array.from(row.querySelectorAll('td, th'));
                    const rowData = cols.map(col => {
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
                link.setAttribute('download', 'laporan_tahunan_{{ request('tahun') ?? date('Y') }}.csv');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        </script>
    @endpush
@endsection
