<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan
    public function index()
    {
        // Mengambil semua pesanan beserta relasi 'user' untuk menampilkan data pemesan
        $pesanans = Pesanan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    // Menampilkan form tambah pesanan
    public function create()
    {
        return view('admin.pesanan.create');
    }

    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Validasi ID user
            'total_harga' => 'required|integer', // Validasi total harga
            'status' => 'required|in:pending,diproses,selesai', // Validasi status pesanan
            'metode_pembayaran' => 'required|in:COD,Transfer', // Validasi metode pembayaran
            'catatan' => 'nullable|string', // Catatan opsional
        ]);

        // Menyimpan data pesanan baru
        Pesanan::create($request->only([
            'user_id',
            'total_harga',
            'status',
            'metode_pembayaran',
            'catatan'
        ]));

        // Redirect ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        // Mengambil pesanan berdasarkan ID dan relasi detailPesanan beserta menu
        $pesanan = Pesanan::with('detailPesanan.menu')->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    // Menampilkan form edit pesanan
    public function edit($id)
    {
        // Mengambil data pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.pesanan.edit', compact('pesanan'));
    }

    // Update status pesanan
    public function update(Request $request, $id)
    {
        // Validasi status pesanan
        $request->validate([
            'status' => 'required',
        ]);

        // Mengambil data pesanan berdasarkan ID dan memperbarui statusnya
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        // Redirect ke daftar pesanan dengan pesan sukses
        return redirect()->route('admin.pesanan.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    // Hapus pesanan
    public function destroy($id)
    {
        // Menghapus pesanan berdasarkan ID
        Pesanan::findOrFail($id)->delete();
        return redirect()->route('admin.pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
