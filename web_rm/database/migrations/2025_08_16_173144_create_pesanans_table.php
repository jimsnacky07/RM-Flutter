<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // pelanggan
            $table->string('nama_pelanggan')->nullable();
            $table->decimal('total_harga', 15, 2);
            $table->enum('status', ['Menunggu Konfirmasi','Diproses','Selesai'])->default('Menunggu Konfirmasi');
            $table->string('metode')->nullable(); // sesuai Flutter
            $table->string('nomor_meja')->nullable();
            $table->string('token')->nullable(); // token Midtrans
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
