<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'user', // default level untuk user mobile
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Register success',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah user ditemukan
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Email tidak ditemukan.',
            ], 404);
        }

        // Cek apakah password yang tersimpan perlu diubah (belum terenkripsi)
        if ($user->level === 'pelanggan' && strlen($user->password) < 60) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Cek apakah password yang diberikan benar
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Password salah.',
            ], 401);
        }

        // Generate token API
        $tokenResult = $user->createToken('API Token');
        $token = $tokenResult->plainTextToken;  // Get the plain text token

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil.',
            'data' => [
                'id' => $user->id,
                'nama' => $user->nama,
                'username' => $user->username,
                'email' => $user->email,
                'level' => $user->level,
                'token' => $token,  // Send the plain text token
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout success'
        ]);
    }
}