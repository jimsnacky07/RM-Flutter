<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'status',
        'total_harga',
        'metode',
        'detail',
        'order_id',
        'snap_token',
        'payment_type',
        'transaction_id',
        'transaction_status',
        'payment_time',
        'va_number',
        'bank'
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'detail' => 'array'
    ];

    // Relasi ke DetailPesanan
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
