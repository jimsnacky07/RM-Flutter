<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategoris')->insert([
            ['nama' => 'Makanan Berat'],
            ['nama' => 'Minuman'],
            ['nama' => 'Cemilan'],
        ]);
    }
}
