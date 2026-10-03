<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo'    => fake()->sentence(),
            'nombre' => fake()->sentence(),
            'precio'  => fake()->randomFloat(2, 1, 200)
        ];
    }
}
