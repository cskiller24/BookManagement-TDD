<?php

namespace Tests\Feature;

use App\Models\Genre;
use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        Storage::fake(Image::STORING_PATH);

        $genre = Genre::factory()->create();

        Image::factory()->genreTestWithImage($genre)->create();

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

        Storage::fake(IMAGE::STORING_PATH);

        $user = User::factory()->create(['is_admin' => true]);

        $this->actingAs($user);

        $image = UploadedFile::fake()->image('test.svg');

        $response = $this->postJson('api/genres', [
            'title' => 'Genre 1',
            'type' => 'Non-Fiction',
            'description' => 'Description 1',
            'image' => $image
        ]);

        $response->assertJsonPath('data.title', 'Genre 1');
        $response->assertJsonPath('data.image.path', $this->parsePath($image->hashName()));
        $response->assertCreated();
    }

    /**
     * @test
     * @return void
     */
    public function itUpdatesAGenre(): void
    {
        Storage::fake(Image::STORING_PATH);

        // $user = User::factory()->create(['is_admin' => true]);

        // $this->actingAs($user);

        $genre = Genre::factory()->create();

        Image::factory()->genreTestWithImage($genre)->create();

        $image = UploadedFile::fake()->image('test.png');
        $response = $this->putJson('api/genres/'.$genre->id, [
            'title' => 'New Genre',
        ]);

        $response->dd();
        // $response->assertJsonPath('data.title', 'New Genre');
        // $response->assertJsonPath('data.image.path', $this->parsePath($image->hashName()));
        // $response->assertOk();
    }

    /**
     * @test
     *
     * @return void
     */
    public function itUpdatesAGenreWithImage(): void
    {
        Storage::fake(Image::STORING_PATH);

        $genre = Genre::factory()->create();

        Image::factory()->genreTestWithImage($genre);

        $response = $this->putJson('api/genres/'.$genre->id, [
            'title' => 'Genre New',
            'image' => UploadedFile::fake()->image('test.png')
        ]);

        $response->dd();
    }

    /**
     * @test
     * @return void
     */
    public function itDeletesAGenre(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user = User::factory()->create(['is_admin' => true]);

        $this->actingAs($user);

        $genre = Genre::factory()->create();

        $image = Image::factory()->genreTestWithImage($genre)->create();

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
