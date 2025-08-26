<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan Form Login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan ada file: resources/views/auth/login.blade.php
    }

    // Proses Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan password benar
        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }

        //Cek level user
        if (!in_array($user->level, ['pelanggan', 'pengguna', 'admin', 'operator'])) {
            return redirect()->back()->withErrors([
                'email' => 'Hanya admin atau operator yang dapat login.',
            ]);
        }

        Auth::login($user);

        // Redirect berdasarkan level user
        return $user->level === 'pelanggan' || 'pengguna'
            ? redirect('/form_pesan')
            : redirect('/admin/dashboard');
    }

    public function formRegister()
    {
        return view('form_pesan'); // Pastikan ada file: resources/views/auth/register.blade.php
    }

    // Registrasi Pengguna Baru
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users', // Pastikan username unik
            'email' => 'required|string|email|max:255|unique:users', // Pastikan email unik
            'password' => 'required|string|min:8|confirmed', // Konfirmasi password
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Membuat user baru
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'pelanggan', // Level 'pelanggan' secara default
        ]);

        // Generate token API
        $token = $user->createToken('API Token')->accessToken;

        // Mengembalikan response sukses
        return response()->json([
            'message' => 'Registrasi berhasil.',
            'data' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'username' => $user->username,
                'email' => $user->email,
                'level' => $user->level,
                'token' => $token,
            ]
        ], 201);
    }

    // Proses Logout
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('auth.login'); // Redirect ke halaman utama setelah logout
    }
}
