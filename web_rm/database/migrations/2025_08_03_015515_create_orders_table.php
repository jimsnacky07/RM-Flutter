<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // relasi ke tabel users
            $table->integer('total_harga');
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->enum('metode_pembayaran', ['COD', 'Transfer'])->default('COD');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
