<?php

namespace Tests\Feature;

use App\Http\Resources\UserResource;
use App\Models\Book;
use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookImageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function itAddsImageToABook(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->postJson("api/books/{$book->id}/images", [
            'image' => UploadedFile::fake()->image('test.jpeg')
        ]);

        $response
            ->assertCreated();
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotAddImageToABookIfImageIsMoreThanThree(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();

        $this->actingAs($user);

        // Automatically Add 3 images to the specific book
        // for ($i = 0; $i < 3; $i++) {
        //     $this->postJson("api/books/{$book->id}/images",[
        //         'image' => UploadedFile::fake()->image('test.jpeg')
        //     ]);
        // }

        Image::factory()->count(3)->bookTest($book)->create();

        $response = $this->postJson("api/books/{$book->id}/images",[
            'image' => UploadedFile::fake()->image('test.jpeg')
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['image' => 'Cannot add more than 3 images in a book']);
    }

    /**
     * @test
     * @return void
     */
    public function itUpdatesAnImageToFeaturedImage(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();

        $this->actingAs($user);

        $image = Image::factory()->bookTest($book)->create();

        $response = $this->putJson("api/books/{$book->id}/images/{$image->id}");

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $image->id);
        $this->assertDatabaseHas($book, ['featured_image_id' => $image->id]);
    }

    /**
     * @test
     * @return void
     */               //WTFFFFFFF is this function name \/\/\/
    public function itDoesNotProcessTheImageIfTheImageIsAlreadyAFeaturedImage(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();

        $this->actingAs($user);

        $image = Image::factory()->bookTest($book)->create();

        $this->assertNotNull($image);

        $response = $this->putJson("api/books/{$book->id}/images/{$image->id}");

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $image->id);
        $this->assertDatabaseHas($book, ['featured_image_id' => $image->id]);

        $response2 = $this->putJson("api/books/{$book->id}/images/{$image->id}");

        $response2
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['image' => 'The image is already a featured image']);
    }

    /**
     * @test
     * @return void
     */
    public function itDeletesAnImageToABook(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();

        $this->actingAs($user);

        $image = Image::factory()->bookTest($book)->create();

        $this->postJson("api/books/{$book->id}/images",[
            'image' => UploadedFile::fake()->image('test.jpeg')
        ]);

        $response = $this->deleteJson("api/books/{$book->id}/images/{$image->id}");

        Storage::assertMissing(Image::STORING_PATH.'/'.$image->path);
        $response->assertNoContent();
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotDeleteTheImageIfNotBelongToABook(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user1 = User::factory()->create();
        $book1 = Book::factory()->for($user1)->create();
        $imageForUser1 = Image::factory()->bookTest($book1)->create();

        $user2 = User::factory()->create();
        $book2 = Book::factory()->for($user2)->create();
        $imageForUser2 = Image::factory()->bookTest($book2)->create();

        $this->actingAs($user2);

        $response = $this->deleteJson("api/books/{$book2->id}/image/{$imageForUser1->id}");

        $response
            ->assertNotFound();
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotDeleteTheImageIfBookHasOneImage(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();
        $image = Image::factory()->bookTest($book)->create();

        $this->actingAs($user);

        $response = $this->deleteJson("api/books/{$book->id}/images/{$image->id}");

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['image' => 'Cannot delete the only image']);
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotDeleteImageIfTheImageIsFeaturedImage(): void
    {
        Storage::fake(Image::STORING_PATH);

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();
        $image = Image::factory()->bookTest($book)->create();
        Image::factory()->bookTest($book)->create();

        $this->actingAs($user);

        $response = $this->putJson("api/books/{$book->id}/images/$image->id}");

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $image->id);

        $response2 = $this->deleteJson("api/books/{$book->id}/images/{$image->id}");

        $response2
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['image' => 'You cannot delete a featured image']);
    }
}
