<?php

namespace Tests\Feature;

use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function itReturnsAllBooks()
    {
        Book::factory()->count(10)->create();

        $response = $this->get('/api/books');


        $response
            ->assertOk()
            ->assertJsonCount(10, 'data');
    }

    /**
     * @test
     */
    public function itReturnsBooksInPaginatedWay(): void
    {
        Book::factory()->count(50)->create();

        $response = $this->get('/api/books');

        $response
            ->assertOk()
            ->assertJsonStructure(['data', 'meta', 'links']);
    }

    /**
     * @test
     * @return void
     */
    public function itSortsBooksByTitleAlphabetically(): void
    {
        Book::factory()->count(10)->create();
        $book1 = Book::factory()->create(['title' => 'AAAA']);
        $book2 = Book::factory()->create(['title' => 'AAAB']);
        $book3 =Book::factory()->create(['title' => 'AAAC']);
        $book4 =Book::factory()->create(['title' => 'AAAD']);

        $response = $this->get('/api/books?sortBy=title');

        $response
            ->assertOk()
            ->assertJsonPath('data.0.title', $book1->title)
            ->assertJsonPath('data.1.title', $book2->title)
            ->assertJsonPath('data.2.title', $book3->title)
            ->assertJsonPath('data.3.title', $book4->title);
    }

    /**
     * @test
     */
    public function itSortsBooksByAuthor(): void
    {
        Book::factory()->count(5)->create();
        $user = User::factory()->create();
        Book::factory()->for($user)->count(3)->create();
        $user2 = User::factory()->create();
        Book::factory()->for($user2)->count(2)->create();

        $response = $this->get('/api/books?sortBy=author');

        $response
            ->assertOk()
            ->assertJsonPath('data.0.user_id', $user->id)
            ->assertJsonPath('data.1.user_id', $user->id)
            ->assertJsonPath('data.2.user_id', $user->id)
            ->assertJsonPath('data.3.user_id', $user2->id)
            ->assertJsonPath('data.4.user_id', $user2->id);
    }

    /**
     * @test
     * @return void
     */
    public function itSortsBooksByFavorites(): void
    {
        $books = Book::factory()->count(10)->create();
        User::factory()->count(3)->create();
        foreach (User::query()->inRandomOrder()->get() as $user) {
            $user->favorites()->attach(
                $books->random()->take(rand(1,2))->pluck('id')
            );
        }
        $users = User::factory()->count(15)->create();
        $book = Book::factory()->create();
        foreach ($users as $user) {
            $user->favorites()->attach($book->id);
        }

        $response = $this->get('/api/books?sortBy=favorites');

        $response
            ->assertOk()
            ->assertJsonPath('data.0.id', $book->id);
    }

    /**
     * @test
     * @return void
     */
    public function itSortsBooksByNumberOfReviews(): void
    {
        Review::factory()->count(10)->create();
        $bookWithoutReview = Book::factory()->create();
        $book = Book::factory()->create();
        $book2 = Book::factory()->create();
        Review::factory()->for($book)->count(11)->create();
        Review::factory()->for($book2)->count(9)->create();

        $response = $this->get('/api/books?sortBy=reviews');

        $response
            ->assertOk()
            ->assertJsonPath('data.0.id', $book->id)
            ->assertJsonPath('data.1.id', $book2->id)
            ->assertJsonPath('data.12.id', $bookWithoutReview->id);
    }

    /**
     * @test
     * @return void
     */
    public function itSortsBookByRecentlyAdded(): void
    {
        Book::factory()->count(10)->create();
        $book1 = Book::factory()->create(['created_at' => now()->addDay()]);
        $book2 = Book::factory()->create(['created_at' => now()->addHour()]);

        $response = $this->get('/api/books?sortBy=recent');

        $response
            ->assertOk()
            ->assertJsonPath('data.0.id', $book1->id)
            ->assertJsonPath('data.1.id', $book2->id);
    }

    /**
     * @test
     * @return void
     */
    public function itReturnsSingleBook(): void
    {
        Book::factory()->count(5)->create();

        $book = Book::factory()->create();

        $response = $this->getJson('api/books/'.$book->id);

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $book->id);
    }

    /**
     * @test
     * @return void
     */
    public function itCreatesBook(): void
    {
        $user = User::factory()->create();
        $genre = Genre::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson('api/books/', [
            'user_id' => $user->id,
            'genre_id' => $genre->id,
            'title' => 'Book Title',
            'description' => 'Book Description'
        ]);

        $response
            ->assertCreated();
    }

    /**
     * @test
     * @return void
     */
    public function itUpdatesBook(): void
    {
        $user = User::factory()->create();
        $genre = Genre::factory()->create();
        $book = Book::factory()
            ->for($user)
            ->create([
                'title' => 'Title 1',
                'description' => 'Description 1',
                'genre_id' => $genre->id
            ]);

        $this->actingAs($user);

        $response = $this->putJson('api/books/'.$book->id, ['title' => 'title2']);

        $response
            ->assertOk()
            ->assertJsonPath('data.title', 'title2')
            ->assertJsonPath('data.description', 'Description 1');
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotUpdateBookIfTheUserIsNotTheAuthor(): void
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();
        Book::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->putJson('api/books/'.$book->id, ['title' => 'New Title']);

        $response->assertForbidden();
    }

    /**
     * @test
     * @return void
     */
    public function itDeletesBook(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->for($user)->create();
        $book2 = Book::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->deleteJson('api/books/'.$book->id);

        $response
            ->assertNoContent();
    }

    /**
     * @test
     * @return void
     */
    public function itDoesNotDeleteBookIfTheUserIsNotTheAuthor(): void
    {
        $book = Book::factory()->create();
        $user = User::factory()->create();
        Book::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->deleteJson('api/books/' . $book->id);

        $response->assertForbidden();
    }

}
