<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
    if (!Schema::hasColumn('pesanans', 'token')) {
        $table->string('token')->nullable()->after('nomor_meja');
    }
    if (!Schema::hasColumn('pesanans', 'nomor_meja')) {
        $table->string('nomor_meja')->nullable()->after('metode');
    }
    if (!Schema::hasColumn('pesanans', 'metode')) {
        $table->string('metode')->nullable()->after('total_harga');
    }
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            //
        });
    }
};
