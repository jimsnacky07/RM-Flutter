<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // <-- ini WAJIB ada

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'level',
        // tambahkan field lain jika ada di tabel users
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Pesanan
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'user_id');
    }

    // Relasi ke Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
}