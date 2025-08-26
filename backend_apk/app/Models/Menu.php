<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'gambar',
        'kategori',
        'barcode'
    ];
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class, 'menu_id');
    }
}