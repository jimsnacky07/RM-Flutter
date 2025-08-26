<?php

use App\Http\Controllers\Api\ApiAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController as MenuController;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\MidtransCallbackController;
use App\Http\Controllers\Api\PaymentStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua route yang didefinisikan disini akan otomatis mendapat prefix /api
| dan dikelompokkan dalam middleware 'api'
*/

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('register', [ApiAuthController::class, 'register']);
    Route::post('logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Menu Routes - Akses publik tanpa perlu login
Route::group(['prefix' => 'menus'], function () {
    Route::get('/', [MenuController::class, 'index']);
    Route::get('/{id}', [MenuController::class, 'show']);
    Route::get('/kategori/{kategori}', [MenuController::class, 'byKategori']);
});

// Pesanan (Order) Routes
Route::prefix('pesanan')->middleware('auth:sanctum')->group(function () {
    // Basic Routes
    Route::get('/', [PesananController::class, 'index']);
    Route::post('/', [PesananController::class, 'store']);
    Route::get('/{id}', [PesananController::class, 'show']);

    // History Route
    Route::get('/histori/{userId}', [PesananController::class, 'history'])
        ->name('pesanan.histori');
    // Route::get('{id}/status', [PesananController::class, 'status'])
    //     ->name('pesanan.status');
    Route::post('{id}/cancel', [PesananController::class, 'cancel'])
        ->name('pesanan.cancel');
});

// Midtrans Notification URL - Tidak perlu CSRF & rate limiting
// Midtrans Webhook - harus di luar middleware auth
Route::post('midtrans/notification', [MidtransCallbackController::class, 'notification'])
    ->name('midtrans.notification')
    ->withoutMiddleware(['auth:sanctum']);

// Payment processing routes
Route::post('payments/process', [PaymentController::class, 'process'])
    ->middleware('auth:sanctum')
    ->name('payment.process');

// Fallback untuk rute yang tidak ditemukan
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Route API tidak ditemukan.'
    ], 404);
});

// Check payment status
Route::get('payments/status/{orderId}', [PaymentStatusController::class, 'check'])
    ->name('payments.status')
    ->withoutMiddleware(['auth:sanctum']); // Bisa diakses tanpa autentikasi