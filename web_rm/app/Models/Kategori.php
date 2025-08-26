<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris'; // sesuaikan nama tabel kategori kamu, biasanya plural
    protected $fillable = ['nama']; // kolom yang bisa diisi massal, misal 'nama' kategori

    // Relasi ke Menu: satu kategori punya banyak menu
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
