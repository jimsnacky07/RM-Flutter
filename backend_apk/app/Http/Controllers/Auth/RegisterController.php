<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Tampilkan Form Registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses Registrasi Pengguna Baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input registrasi
        $validated = $request->validate([
            'nama' => 'required|string|max:255',  // Pastikan nama tidak kosong
            'username' => 'required|string|max:255|unique:users,username',  // Validasi unique untuk username
            'email' => 'required|string|email|max:255|unique:users,email',  // Validasi unique untuk email
            'password' => 'required|string|min:8|confirmed',  // Validasi password dan konfirmasinya
        ]);

        // Menyimpan pengguna baru ke database
        User::create([
            'nama' => $validated['nama'], 
            'username' => $validated['username'], // Menyimpan username
            'email' => $validated['email'], 
            'password' => Hash::make($validated['password']),  // Enkripsi password
            'level' => 'pelanggan',  // Set level sebagai pelanggan (default)
        ]);

        // Redirect ke halaman login setelah registrasi sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
