<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->unique()->safeEmail,
            'phone_number' => fake()->phoneNumber,
            'date_of_birth' => fake()->date('Y-m-d', '2005-01-01'), // Example date format
            'address' => fake()->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}


