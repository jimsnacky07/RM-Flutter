<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MenuSeeder::class,
        ]);

        // Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'level' => 'admin',
            ]
        );

        // Operator
        User::firstOrCreate(
            ['email' => 'operator@example.com'],
            [
                'name' => 'Operator',
                'username' => 'operator',
                'password' => Hash::make('operator123'),
                'level' => 'operator',
            ]
        );

        // 20 pelanggan
        for ($i = 1; $i <= 20; $i++) {
            User::firstOrCreate(
                ['email' => "pelanggan{$i}@example.com"],
                [
                    'name' => "Pelanggan {$i}",
                    'username' => "pelanggan{$i}",
                    'password' => Hash::make('pelanggan123'),
                    'level' => 'pelanggan',
                ]
            );
        }
    }
}
