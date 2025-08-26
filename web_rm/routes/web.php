<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\Operator\PesananController as OperatorPesananController;
use App\Http\Controllers\Operator\MenuController as OperatorMenuController;

// ================== LOGIN / LOGOUT ==================
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ================== REGISTER ==================
Route::get('/register', [LoginController::class, 'register'])->name('register');

// ================== ADMIN ==================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Resource untuk Pengguna
    Route::resource('pengguna', PenggunaController::class);

    // Pesanan (Admin)
    Route::get('/pesanan/{id}', [AdminPesananController::class, 'show'])->name('pesanan.show');
    Route::get('/pesanan/{id}/edit', [AdminPesananController::class, 'edit'])->name('pesanan.edit');
    Route::put('/pesanan/{id}', [AdminPesananController::class, 'update'])->name('pesanan.update');
    Route::resource('pesanan', AdminPesananController::class)->except(['show', 'edit', 'update']);

    // Menu (Admin)
    Route::resource('menus', AdminMenuController::class)->except(['show']);
    Route::get('/menus/generateQRCode', [AdminMenuController::class, 'generateQRCode'])->name('menus.generateQRCode');

    // Laporan Penjualan Bulanan (Admin)
    Route::get('/laporan-bulanan', [LaporanController::class, 'laporanBulanan'])
        ->name('laporan.bulanan');

    Route::get('/laporan-tahunan', [LaporanController::class, 'laporanTahunan'])
        ->name('laporan.tahunan');

    // Register (Admin) - untuk admin yang sudah login
    Route::post('/register', [LoginController::class, 'registerStore'])->name('register.store');
});

// ================== OPERATOR ==================
// Frontend Routes
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/pemesanan', [App\Http\Controllers\Frontend\MenuController::class, 'index'])->name('menu.index');
    Route::post('/order', [App\Http\Controllers\Frontend\OrderController::class, 'store'])->name('order.store');
});

Route::prefix('operator')->name('operator.')->group(function () {
    Route::get('/dashboard', [OperatorController::class, 'dashboard'])->name('dashboard');

    // Menu Management
    Route::get('/menus', [OperatorMenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/{id}', [OperatorMenuController::class, 'show'])->name('menus.show');

    // Pesanan Management
    Route::get('/pesanan', [OperatorPesananController::class, 'index'])->name('pesanan.index');
    Route::patch('/pesanan/{id}/status', [OperatorPesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

    // ================== API UNTUK FLUTTER ==================
    Route::post('/checkout', [OperatorPesananController::class, 'checkout'])->name('pesanan.checkout');
    Route::get('/riwayat/{user_id}', [OperatorPesananController::class, 'riwayat'])->name('pesanan.riwayat');
});
