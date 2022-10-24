<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucfirst(fake()->sentence(10)),
            'label' => fake()->lexify(str_repeat('?', rand(4, 8))),
            'price' => fake()->numberBetween(500_000, 10_000_000)
        ];
    }
}
