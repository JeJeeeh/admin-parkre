<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'score' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->text,
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
            'updated_at' => now(),
        ];
    }
}
