<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_code' => 'ORDER-' . strtoupper(Str::random(10)),
            'total_amount' => $this->faker->numberBetween(100000, 5000000),
            'status' => $this->faker->randomElement(['pending', 'paid', 'cancelled', 'complete']),
        ];
    }
}
