<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = ['nama', 'deskripsi', 'harga', 'gambar', 'kategori', 'stok', 'barcode'];

    // Relasi ke model Kategori (jika ada tabel kategori)
    // Note: Field kategori sekarang adalah string, bukan foreign key
    // public function kategori()
    // {
    //     return $this->belongsTo(Kategori::class);
    // }
}
