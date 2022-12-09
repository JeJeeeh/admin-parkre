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
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'price' => $this->faker->numberBetween(5000, 50000),
            'status' => $this->faker->numberBetween(0, 1),
            'date' => $this->faker->date(),
            'user_id' => $this->faker->numberBetween(1, 10),
            'segmentation_id' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
            'vehicle_id' => $this->faker->numberBetween(1, 10),
            'updated_at' => now(),
        ];
    }
}
