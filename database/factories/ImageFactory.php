<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.       
     *
     * @var string
     */
    protected $model = Image::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'resource_id' => $this->faker->randomDigit(),
            'resource_type' => Str::random(10),
            'path' => $this->faker->image(public_path('storage/images'), 640, 480, null, false)
        ];
    }
}
