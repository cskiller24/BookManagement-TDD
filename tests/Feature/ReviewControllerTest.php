<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     * @return void
     */
    public function itDisplaysAllTheReviewsOfTheBook(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();
        Review::factory()->for($book)->count(3)->create();

        $this->actingAs($user);

        $response = $this->getJson("api/books/{$book->id}/reviews");

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $book->id);
    }

    /**
     * @test
     * @return void
     */
    public function itStoresAReviewInABook(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson("api/books/{$book->id}/reviews",[
            'star' => rand(1,5),
            'title' => $this->faker()->sentence(3),
            'description' => $this->faker()->sentences(3, true)
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.user_id', $user->id)
            ->assertJsonPath('data.book_id', $book->id);
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotCreateAReviewIfUserIsTheAuthorOfTheBook(): void
    {

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->postJson("api/books/{$book->id}/reviews",[
            'star' => rand(1,5),
            'title' => $this->faker()->sentence(3),
            'description' => $this->faker()->sentences(3, true)
        ]);

        $response->assertForbidden();
    }

    /**
     * @test
     * @return void
     */
    public function itDisplaysSpecificReview(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();
        $review = Review::factory()->for($book)->create();
        Review::factory()->for($book)->create();

        $this->actingAs($user);

        $response = $this->getJson("api/books/{$book->id}/reviews/{$review->id}");

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $review->id)
            ->assertJsonPath('data.book.id', $book->id);
    }

    /**
     * @test
     * @return void
     */
    public function itUpdatesAReviewInABook(): void
    {

        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();
        $review = Review::factory()->for($book)->create();

        $this->actingAs($user);

        $bookTitle = 'New Title';

        $response = $this->putJson("api/books/{$book->id}/reviews/{$review->id}", [
            'title' => $bookTitle
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('data.title', $bookTitle);
    }

    /**
     * @test
     * @return void
     */
    public function itDeletesAReviewInABook(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();
        $review = Review::factory()->for($book)->create();

        $this->actingAs($user);

        $response = $this->deleteJson("api/books/{$book->id}/reviews/{$review->id}");

        $response
            ->assertNoContent();
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotDeleteAndUpdateReviewIfUserIsNotTheAuthor(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $review = Review::factory()->for($book)->create();

        $this->actingAs($user);

        $response = $this->putJson("api/books/{$book->id}/reviews/{$review->id}", [
            'title' => 'Update'
        ]);

        $response->assertForbidden();

        $response = $this->deleteJson("api/books/{$book->id}/reviews/{$review->id}");

        $response->assertForbidden();
    }

    /**
     * @test
     * @return void
     */
    public function itCollectsAllTheReviewsOfUser(): void
    {
        $user = User::factory()->create();
        Review::factory()->for($user)->count(3)->create();

        $this->actingAs($user);

        $response = $this->getJson("api/reviews");

        $response
            ->assertOk()
            ->assertJsonCount(3, 'data.reviews');
    }
}
