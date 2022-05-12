<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => Str::title($this->faker->sentence()),
            'type' => $this->faker->randomElement(['Fiction', 'Non-Fiction']),
            'description' => $this->faker->sentences('3', true)
        ];
    }
}
