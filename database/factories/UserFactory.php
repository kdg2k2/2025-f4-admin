<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'path' => null,
            'password_reset_code' => null,
            'password_reset_expires_at' => null,
            'verified_at' => $this->faker->randomElement([true, false]),
        ];
    }
}
