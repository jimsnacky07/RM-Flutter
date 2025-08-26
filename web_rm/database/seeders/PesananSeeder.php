<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;

class PesananSeeder extends Seeder
{
    public function run()
    {
        Pesanan::create([
            'nama_pelanggan' => 'Dian',
            'total_harga' => 55000,
            'status' => 'Menunggu'
        ]);

        Pesanan::create([
            'nama_pelanggan' => 'Putri',
            'total_harga' => 75000,
            'status' => 'Diproses'
        ]);
    }
}
