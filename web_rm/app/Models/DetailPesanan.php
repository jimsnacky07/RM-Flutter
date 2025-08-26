<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanans'; // pastikan ini sama dengan nama tabel di database

    protected $fillable = ['pesanan_id', 'menu_id', 'jumlah', 'harga', 'subtotal'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}
