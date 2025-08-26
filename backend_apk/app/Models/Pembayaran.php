<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Kalau nama tabel kamu bukan 'pembayarans', aktifkan baris ini:
    // protected $table = 'pembayaran';

    protected $fillable = [
        'order_id',
        'total',
        'metode',
        'tanggal',
        // tambahkan field lain jika ada di tabel pembayarans
    ];

    // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
