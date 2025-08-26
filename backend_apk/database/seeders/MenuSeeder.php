<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'nama_menu' => 'Rendang',
                'deskripsi' => 'Rendang daging sapi khas Minang',
                'harga' => 35000,
                'kategori' => 'Makanan Utama',
                'gambar' => 'rendang.png',
                'status' => 'Tersedia'
            ],
            [
                'nama_menu' => 'Gulai Tunjang',
                'deskripsi' => 'Gulai kikil sapi khas Minang',
                'harga' => 30000,
                'kategori' => 'Makanan Utama',
                'gambar' => 'gulai_tunjang.png',
                'status' => 'Tersedia'
            ],
            [
                'nama_menu' => 'Dendeng Balado',
                'deskripsi' => 'Dendeng sapi dengan balado merah',
                'harga' => 40000,
                'kategori' => 'Makanan Utama',
                'gambar' => 'dendeng_balado.png',
                'status' => 'Tersedia'
            ],
            [
                'nama_menu' => 'Ayam Goreng',
                'deskripsi' => 'Ayam goreng renyah',
                'harga' => 25000,
                'kategori' => 'Makanan Utama',
                'gambar' => 'ayam_goreng.png',
                'status' => 'Tersedia'
            ],
            [
                'nama_menu' => 'Ikan Bakar',
                'deskripsi' => 'Ikan bakar bumbu khas',
                'harga' => 35000,
                'kategori' => 'Makanan Utama',
                'gambar' => 'ikan_bakar.png',
                'status' => 'Tersedia'
            ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
