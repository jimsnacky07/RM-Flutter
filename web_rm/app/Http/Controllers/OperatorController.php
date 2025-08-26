<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Pesanan;

class OperatorController extends Controller
{
    // Cek user level operator
    private function checkOperator()
    {
        $user = Auth::user();
        if (!$user || $user->level !== 'operator') {
            abort(403, 'Akses ditolak');
        }
    }

    // Dashboard Operator
    public function dashboard()
    {
        $this->checkOperator();

        $totalMenu = Menu::count();
        $totalPesanan = Pesanan::count();
        $menuTerbaru = Menu::orderBy('created_at', 'desc')->first();

        $pesananHariIni = Pesanan::whereDate('created_at', today())->count();
        $pesananMenunggu = Pesanan::where('status', 'pending')->count();

        $pendapatanHariIni = Pesanan::whereDate('created_at', today())->sum('total_harga');

        // Pesanan terbaru dengan detail menu dan info user
        $pesananTerbaru = Pesanan::with(['detailPesanan.menu', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('operator.dashboard', compact(
            'totalMenu',
            'totalPesanan',
            'menuTerbaru',
            'pesananHariIni',
            'pesananMenunggu',
            'pendapatanHariIni',
            'pesananTerbaru'
        ));
    }
}
