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
    public function definition(): array
    {
        return [
            'resource_id' => $this->faker->randomDigit(),
            'resource_type' => Str::random(10),
            'path' => 'default_image.png'
        ];
    }

    public function book($book): self
    {
        return $this->state(function (array $attributes) use ($book){
            return [
                'resource_id' => $book->getKey(),
                'resource_type' => $book->getMorphClass(),
            ];
        });
    }

    public function bookTest($book): self
    {
        return $this->state(function (array $attributes) use ($book) {
            return [
                'resource_id' => $book->getKey(),
                'resource_type' => $book->getMorphClass(),
                'path' => Storage::fake(Image::STORING_PATH)->put('', UploadedFile::fake()->image('test.png')) // TODO
            ];
        });
    }

    public function publicImage(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'path' => $this->faker->image(public_path('storage/images'), 640, 480, null, false)
            ];
        });
    }

    public function genreTestWithImage($genre): self
    {
        return $this->state(function (array $attributes) use ($genre){
            return [
                'resource_id' => $genre->getKey(),
                'resource_type' => $genre->getMorphClass(),
                'path' => Storage::fake(Image::STORING_PATH)->put('', UploadedFile::fake()->image('test.png'))
            ];
        });
    }
}
