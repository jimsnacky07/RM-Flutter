<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Halaman utama

Route::get('/', function () {
    return view('auth.login');
});

// Storage public file
Route::get('/storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
})->where('path', '.*');

Route::middleware('guest')->group(function () {
    // Menampilkan form login
    Route::get('auth/login', [AuthController::class, 'showLoginForm'])->name('login');


    // Proses login
    Route::post('auth/login', [AuthController::class, 'login'])->name('login.proses');
    // Proses registrasi
    Route::get('auth/register', [AuthController::class, 'register'])->name('register');
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('destroy');
});