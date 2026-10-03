<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_cliente'    => fake()->name(),
            'direccion_cliente' => fake()->address(),
            'telefono_cliente'  => fake()->numerify('##########'),
            'email_cliente'     => fake()->unique()->safeEmail(),
            'user_id'=>User::factory()
        ];
    }
}
