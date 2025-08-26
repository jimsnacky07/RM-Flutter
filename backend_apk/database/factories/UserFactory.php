<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
        'nama' => $this->faker->name(),
        'username' => $this->faker->unique()->userName(),
        'email' => $this->faker->unique()->safeEmail(),
        'password' => bcrypt('password123'),
        'level' => 'pelanggan',
    ];
    }
}
