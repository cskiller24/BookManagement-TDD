<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookFavoriteControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function itAddsABookToFavorites(): void
    {
        Book::factory()->count(5)->create();
        $book = Book::factory()->create();
        $user = User::factory()->create();

        $this->actAsUser($user);

        $response = $this->postJson("api/books/{$book->id}/favorites");

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $book->id);
    }

    /**
     * @test
     * @return void
     */
    public function itDeletesABookToFavorites(): void
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();
        $user->favorites()->attach($book->id);

        $this->actAsUser($user);

        $response = $this->deleteJson('api/books/' . $book->id . '/favorites');

        $response
            ->assertNoContent();
    }
}
