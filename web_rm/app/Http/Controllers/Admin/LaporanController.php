<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    // LAPORAN BULANAN (detail pesanan per hari)
    public function laporanBulanan(Request $request)
    {
        // Ambil bulan & tahun dari request (default: bulan & tahun sekarang)
        $bulan = $request->input('bulan', Carbon::now()->format('m'));
        $tahun = $request->input('tahun', Carbon::now()->format('Y'));

        // Query semua pesanan dalam bulan tsb dengan relasi
        $pesanans = Pesanan::with(['user', 'detailPesanan.menu'])
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung total
        $totalPesanan = $pesanans->count();
        $totalPendapatan = $pesanans->sum('total_harga');

        // Query untuk grafik per hari (jika diperlukan)
        $laporanHarian = Pesanan::select(
            DB::raw('DAY(created_at) as tanggal'),
            DB::raw('COUNT(id) as total_pesanan'),
            DB::raw('SUM(total_harga) as total_pendapatan')
        )
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('admin.laporan.bulanan', compact(
            'pesanans',
            'laporanHarian',
            'bulan',
            'tahun',
            'totalPesanan',
            'totalPendapatan'
        ));
    }

    // LAPORAN TAHUNAN (agregat per bulan)
    public function laporanTahunan(Request $request)
    {
        // Ambil tahun dari request (default: tahun ini)
        $tahun = $request->input('tahun', Carbon::now()->format('Y'));

        // Query total penjualan per bulan dalam tahun tsb
        $laporanBulanan = Pesanan::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('YEAR(created_at) as tahun'),
            DB::raw('COUNT(id) as total_pesanan'),
            DB::raw('SUM(total_harga) as total_pendapatan')
        )
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan', 'tahun')
            ->orderBy('bulan', 'asc')
            ->get();

        // Hitung total tahunan
        $totalPesanan = $laporanBulanan->sum('total_pesanan');
        $totalPendapatan = $laporanBulanan->sum('total_pendapatan');

        // Tambahkan trend analysis
        $laporanBulanan = $laporanBulanan->map(function ($item) use ($laporanBulanan) {
            $bulan = $item->bulan;
            $pendapatan = $item->total_pendapatan;

            // Cari bulan sebelumnya untuk trend
            $bulanSebelumnya = $bulan - 1;
            if ($bulanSebelumnya < 1) {
                $bulanSebelumnya = 12;
            }

            $pendapatanSebelumnya = $laporanBulanan->where('bulan', $bulanSebelumnya)->first()->total_pendapatan ?? 0;

            // Hitung trend
            if ($pendapatan > $pendapatanSebelumnya) {
                $trend = 'up';
            } elseif ($pendapatan < $pendapatanSebelumnya) {
                $trend = 'down';
            } else {
                $trend = 'stable';
            }

            $item->trend = $trend;
            return $item;
        });

        return view('admin.laporan.tahunan', compact(
            'laporanBulanan',
            'tahun',
            'totalPesanan',
            'totalPendapatan'
        ));
    }
}
