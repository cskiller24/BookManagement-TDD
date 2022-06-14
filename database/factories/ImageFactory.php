<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
            'path' => 'default_image.png'
        ];
    }

    public function book($book)
    {
        return $this->state(function (array $attributes) use ($book){
            return [
                'resource_id' => $book->getKey(),
                'resource_type' => $book->getMorphClass(),
            ];
        });
    }

    public function bookTest($book)
    {
        return $this->state(function (array $attributes) use ($book) {
            return [
                'resource_id' => $book->getKey(),
                'resource_type' => $book->getMorphClass(),
                'path' => Storage::fake(Image::STORING_PATH)->put('', UploadedFile::fake()->image('test.png')) // TODO
            ];
        });
    }

    public function publicImage()
    {
        return $this->state(function (array $attributes) {
            return [
                'path' => $this->faker->image(public_path('storage/images'), 640, 480, null, false)
            ];
        });
    }
}
