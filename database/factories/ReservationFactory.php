<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'initial_price' => $this->faker->numberBetween(5000, 50000),
            'price' => $this->faker->numberBetween(5000, 50000),
            'status' => $this->faker->numberBetween(0, 1),
            'user_id' => $this->faker->numberBetween(1, 10),
            'segmentation_id' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
