<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'genre_id' => Genre::factory(),
            'title' => Str::title($this->faker->sentence()),
            'description' => $this->faker->sentences(3, true),
        ];
    }

    public function existingGenre()
    {
        $totalGenre = Genre::all()->count();
        return $this->state(function (array $attributes) use ($totalGenre) {
            return [
                'genre_id' => rand(1, $totalGenre),
            ];
        });
    }
}
