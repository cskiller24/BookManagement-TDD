<?php

namespace Tests\Feature;

use App\Models\Genre;
use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GenreControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function itDisplaysAllGenres()
    {
        Storage::fake(Image::DISK);

        $genre = Genre::factory()->create();

        Image::factory()->genreImage($genre)->create();

        $response = $this->getJson('api/genres');
        $response->assertJsonPath('data.0.id', $genre->id);
        $response->assertOk();
    }

    /**
     * @test
     * @return void
     */
    public function itCreatesAGenreWithImage()
    {
        Storage::fake(IMAGE::DISK);

        $this->actAsAdmin();

        $image = UploadedFile::fake()->image('test.svg');

        $response = $this->postJson('api/genres', [
            'title' => 'Genre 1',
            'type' => 'Non-Fiction',
            'description' => 'Description 1',
            'image' => $image
        ]);

        $response->assertJsonPath('data.title', 'Genre 1');
        $response->assertJsonPath('data.image.path', image_url($image->hashName()));
        $response->assertCreated();
    }

    /**
     * @test
     * @return void
     */
    public function itUpdatesAGenre(): void
    {
        Storage::fake(Image::DISK);
        $this->actAsAdmin();
        $genre = Genre::factory()->create();

        Image::factory()->genreImage($genre)->create();

        $response = $this->putJson('api/genres/'.$genre->id, [
            'title' => 'New Genre',
        ]);

        $response->assertOk();
        $response->assertJsonPath('data.title', 'New Genre');
    }

    /**
     * @test
     *
     * @return void
     */
    public function itUpdatesAGenreWithImage(): void
    {
        Storage::fake(Image::DISK);

        $genre = Genre::factory()->create();

        Image::factory()->genreImage($genre)->create();
        $this->actAsAdmin();
        $image = UploadedFile::fake()->image('test.png');
        $response = $this->putJson('api/genres/'.$genre->id, [
            'title' => 'Genre New',
            'image' => $image
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('data.title', 'Genre New')
            ->assertJsonPath('data.image.path', image_url($image->hashName()));
    }

    /**
     * @test
     * @return void
     */
    public function itDeletesAGenre(): void
    {
        Storage::fake(Image::DISK);
        $this->actAsAdmin();
        $genre = Genre::factory()->create();

        $image = Image::factory()->genreImage($genre)->create();

        $response = $this->deleteJson('api/genres/'.$genre->id);

        $response->assertNoContent();
    }

    private function parsePath(string $path): string
    {
        return sprintf('http://%s:%s/storage/images/%s',
            config('app.test_domain', 'api.book-management.test'),
            config('app.test_port', 8000),
            $path
        );
    }
}
