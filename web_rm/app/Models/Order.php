<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Nama tabel kalau tidak sesuai default
    protected $table = 'orders';

    // Field yang bisa diisi massal
    protected $fillable = [
        'user_id',
        'order_id',
        'total_harga',
        'status',        // contoh: 'pending', 'waiting_payment', 'paid', 'cancelled', 'failed'
        'metode_pembayaran', // contoh: 'COD' atau 'Transfer'
        'catatan',       // optional: catatan pesanan
        'items',         // JSON field untuk detail items
        'snap_token',    // token dari Midtrans
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke detail pesanan (jika ada tabel order_details)
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
