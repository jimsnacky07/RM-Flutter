<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create([
            'nama' => 'Rendang',
            'harga' => 28000,
            'deskripsi' => 'Rendang khas Padang',
            'kategori' => 'Makanan Berat',
            'gambar' => 'rendang.png',
        ]);

        Menu::create([
            'nama' => 'Gulai Tunjang',
            'harga' => 30000,
            'deskripsi' => 'Gulai tunjang pedas nikmat',
            'kategori' => 'Makanan Berat',
            'gambar' => 'gulai_tunjang.png',
        ]);

        Menu::create([
            'nama' => 'Ayam Goreng',
            'harga' => 25000,
            'deskripsi' => 'Ayam goreng renyah',
            'kategori' => 'Makanan Berat',
            'gambar' => 'ayam_goreng.png',
        ]);
        
        Menu::create([
            'nama' => 'Dendeng Balado',
            'harga' => 30000,
            'deskripsi' => 'Dendeng balado yang pedas dan lezat',
            'kategori' => 'Makanan Berat',
            'gambar' => 'dendeng_balado.png',
        ]);
        Menu::create([
            'nama' => 'Gulai Tambusu',
            'harga' => 25000,
            'deskripsi' => 'Gulai Tambusu yang lezat dan nikmat',
            'kategori' => 'Makanan Berat',
            'gambar' => 'gulai_tambusu.png',
        ]);
        Menu::create([
            'nama' => 'Ikan Bakar',
            'harga' => 10000,
            'deskripsi' => 'Ikan Bakar dengan bumbu khas minang',
            'kategori' => 'Makanan Berat',
            'gambar' => 'ikan_bakar.png',
        ]);
        Menu::create([
            'nama' => 'Telur Barendo',
            'harga' => 15000,
            'deskripsi' => 'Telur Barendo nan lamak',
            'kategori' => 'Makanan Berat',
            'gambar' => 'telur_barendo.png',
        ]);
        Menu::create([
            'nama' => 'Kalio Jariang',
            'harga' => 18000,
            'deskripsi' => 'Kalio jariang dengan kuah yang menggugah selera',
            'kategori' => 'Makanan Berat',
            'gambar' => 'kalio_jariang.png',
        ]);
        Menu::create([
            'nama' => 'Udang Balado',
            'harga' => 15000,
            'deskripsi' => 'Udang balado gurih dan pedas',
            'kategori' => 'Makanan Berat',
            'gambar' => 'udang_balado.png',
        ]);
        Menu::create([
            'nama' => 'Jangek Siram',
            'harga' => 15000,
            'deskripsi' => 'kerupuk kulit yang disiram dengan kuah',
            'kategori' => 'Makanan Ringan',
            'gambar' => 'jangek_siram.png',
        ]);
        Menu::create([
            'nama' => 'Telur Bulat Balado',
            'harga' => 13000,
            'deskripsi' => 'sambel khas minang',
            'kategori' => 'Makanan Berat',
            'gambar' => 'telur_bulat_balado.png',
        ]);
    }
}
