<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageDeleteCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * This remove all the files in the actual folder but this test passes
     * @return void
     */
    public function itDeletesImagesInFolder(): void
    {
        Storage::fake('');
        $book = Book::factory()->create();

        $image = $this->postJson("api/books/{$book->id}/images", [
            'image' => UploadedFile::fake()->image('test.jpg')
        ]);

        Storage::assertExists($image->json('data.path'));

        $this
            ->artisan('images:delete')
            ->expectsConfirmation('This will delete all the images. Do you wish to continue?', 'yes')
            ->assertSuccessful();

        Storage::assertDirectoryEmpty('');
    }
}
