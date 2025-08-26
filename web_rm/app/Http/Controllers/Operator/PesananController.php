<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;

class PesananController extends Controller
{
    // Cek user level operator
    private function checkOperator()
    {
        $user = Auth::user();
        if (!$user || $user->level !== 'operator') {
            abort(403, 'Akses ditolak');
        }
    }

    // List semua pesanan untuk operator dengan filter status
    public function index(Request $request)
    {
        $this->checkOperator();

        $query = Pesanan::with(['user', 'detailPesanan.menu'])->latest();

        if ($request->status && $request->status != '') {
            $query->where('status', $request->status);
        }

        $pesanans = $query->get();

        return view('operator.pesanan.index', compact('pesanans'));
    }

    // Checkout dari Flutter, simpan pesanan & detail
    public function checkout(Request $request)
    {
        $this->checkOperator();

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_harga' => 'required|numeric|min:1',
            'metode' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga' => 'required|numeric|min:1',
            'nama_pelanggan' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $pesanan = Pesanan::create([
                'user_id' => $request->user_id,
                'nama_pelanggan' => $request->nama_pelanggan,
                'total_harga' => $request->total_harga,
                'status' => 'pending', // default sesuai DB
                'metode' => $request->metode,
            ]);

            foreach ($request->items as $item) {
                $pesanan->detailPesanan()->create([
                    'menu_id' => $item['menu_id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'subtotal' => $item['jumlah'] * $item['harga'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'pesanan_id' => $pesanan->id,
                'data' => $pesanan->load('detailPesanan.menu', 'user'),
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Update status pesanan (operator)
    public function updateStatus(Request $request, $id)
    {
        $this->checkOperator();

        $request->validate([
            'status' => 'required|in:pending,Dikonfirmasi,Diproses,Selesai,Dibatalkan',
        ]);

        try {
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->update(['status' => $request->status]);

            return redirect()->route('operator.pesanan.index')
                ->with('success', 'Status pesanan berhasil diubah.');
        } catch (\Throwable $e) {
            return redirect()->route('operator.pesanan.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Riwayat pesanan pelanggan (API untuk Flutter)
    public function riwayat($user_id)
    {
        $this->checkOperator();

        $pesanan = Pesanan::with('detailPesanan.menu')
            ->where('user_id', $user_id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pesanan,
        ]);
    }
}
