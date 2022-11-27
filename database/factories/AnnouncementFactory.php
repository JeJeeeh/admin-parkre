<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'header' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'status' => $this->faker->numberBetween(0, 2), // 0 = inactive, 1 = active, 2 = all malls
            'mall_id' => $this->faker->numberBetween(1, 10),
            'staff_id' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
