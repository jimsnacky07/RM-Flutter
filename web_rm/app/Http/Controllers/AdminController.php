<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Cek login
    private function checkLogin()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login dulu.')->send();
        }
    }

    // Dashboard admin
    public function dashboard()
    {
        $this->checkLogin();

        // Ambil semua pesanan dengan relasi user & detail menu
        $orders = Pesanan::with(['detailPesanan.menu', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Statistik
        $totalPengguna   = User::count();
        $menuTerbaru     = Menu::latest()->value('nama'); // <-- diperbaiki
        $totalPesanan    = $orders->count();
        $totalPendapatan = $orders->sum('total_harga');
        $pesananMenunggu = $orders->where('status', 'Menunggu Konfirmasi')->count();

        return view('admin.dashboard', compact(
            'orders',
            'totalPengguna',
            'menuTerbaru',
            'totalPesanan',
            'totalPendapatan',
            'pesananMenunggu'
        ));
    }

    // List semua pengguna
    public function penggunaIndex()
    {
        $this->checkLogin();

        $pengguna = User::orderBy('id', 'desc')->get();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    // Form tambah pengguna
    public function penggunaCreate()
    {
        $this->checkLogin();
        return view('admin.pengguna.create');
    }

    // Simpan pengguna baru
    public function penggunaStore(Request $request)
    {
        $this->checkLogin();

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'level' => 'required|in:admin,operator,pelanggan',
        ]);

        User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'level' => $data['level'],
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    // Form edit pengguna
    public function penggunaEdit($id)
    {
        $this->checkLogin();

        $pengguna = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    // Update pengguna
    public function penggunaUpdate(Request $request, $id)
    {
        $this->checkLogin();

        $pengguna = User::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($pengguna->id)],
            'level' => 'required|in:admin,operator,pelanggan',
            'password' => 'nullable|string|min:6',
        ]);

        $pengguna->nama = $data['nama'];
        $pengguna->email = $data['email'];
        $pengguna->level = $data['level'];

        if (!empty($data['password'])) {
            $pengguna->password = Hash::make($data['password']);
        }

        $pengguna->save();

        return redirect()->route('admin.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // Hapus pengguna
    public function penggunaDestroy($id)
    {
        $this->checkLogin();

        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
