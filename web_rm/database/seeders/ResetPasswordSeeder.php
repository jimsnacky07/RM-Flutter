<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $kolomRole = 'level'; // Ganti sesuai nama kolom di tabel users

        $passwords = [
            'admin'     => 'admin123',
            'operator'  => 'operator123',
            'pelanggan' => 'pelanggan123',
        ];

        foreach ($passwords as $role => $password) {
            DB::table('users')
                ->where($kolomRole, $role)
                ->update([
                    'password' => Hash::make($password)
                ]);
        }

        $this->command->info('✅ Semua password berhasil direset sesuai role.');
    }
}
