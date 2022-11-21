<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_number' => fake()->numerify("############"),
            'amout' => fake()->numberBetween(500_000, 2_000_000),
            'status' => 'PENDING',
            'email' => fake()->email(),
            'contact' => fake()->phoneNumber(),
            'shipping_agent' => 'JNE',
            'shipping_tracking_number' => fake()->numerify('################'),
            'shipping_address' => fake()->address()
        ];
    }
}
