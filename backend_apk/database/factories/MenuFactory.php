<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'nama' => $this->faker->word(),
           'harga' => $this->faker->randomFloat(2, 5000, 50000),
           'gambar' => $this->faker->imageUrl(640, 480, 'food', true, 'Menu'),
           'deskripsi' => $this->faker->sentence(8),
           'kategori' => $this->faker->randomElement(['nasi', 'minuman', 'dessert', 'pedas']),
        ];
    }
}
