<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Segmentation>
 */
class SegmentationFactory extends Factory
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
            'park_space' => $this->faker->numberBetween(50, 100),
            'reserve_space' => $this->faker->numberBetween(1, 50),
            'initial_price' => $this->faker->numberBetween(5000, 50000),
            'price' => $this->faker->numberBetween(5000, 50000),
            'mall_id' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
