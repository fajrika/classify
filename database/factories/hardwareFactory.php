<?php

namespace Database\Factories;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\hardware>
 */
class hardwareFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' => fake()->userName(),
            'plant_id' => Plant::all()->random()->id,
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),

        ];
    }
}
