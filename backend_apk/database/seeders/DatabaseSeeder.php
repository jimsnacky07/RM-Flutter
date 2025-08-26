<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'level' => 'admin',
        ]);

        // Operator
        User::create([
            'nama' => 'Operator',
            'username' => 'operator',
            'email' => 'operator@example.com',
            'password' => Hash::make('operator123'),
            'level' => 'operator',
        ]);

        // 20 Pelanggan
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'nama' => 'Pelanggan ' . $i,
                'username' => 'pelanggan' . $i,
                'email' => 'pelanggan' . $i . '@example.com',
                'password' => Hash::make('password'),
                'level' => 'pelanggan',
            ]);
        }

        // Jalankan Menu Seeder
        $this->call([
            MenuSeeder::class,
        ]);
    }
}
