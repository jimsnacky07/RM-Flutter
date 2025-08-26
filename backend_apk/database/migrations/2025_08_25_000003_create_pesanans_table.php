<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_pelanggan');
            $table->enum('status', [
                'Menunggu Pembayaran',
                'Pembayaran Berhasil',
                'Diproses',
                'Dikirim',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu Pembayaran');
            $table->string('metode')->nullable();
            $table->decimal('total_harga', 10, 2);
            $table->json('detail')->nullable();
            $table->string('order_id')->unique()->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
};
