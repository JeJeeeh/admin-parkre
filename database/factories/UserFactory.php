<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'address' => $this->faker->address,
            'phone' => $this->faker->numberBetween(100000000000, 999999999999),
            'balance' => $this->faker->numberBetween(100000, 999999),
            'fcm_token' => 'fcm_token',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
