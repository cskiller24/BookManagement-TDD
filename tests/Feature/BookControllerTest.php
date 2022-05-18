<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
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
    public function itSortsBooksByPopularity(): void
    {
        Book::factory()->count(10)->create();

        // Add random favorites
        $books = Book::query()->inRandomOrder()->get();
        foreach (User::all() as $user) {
            $user->favorites()
                ->attach(
                    $books->random()->take(rand(1,2))->pluck('id')
                );
        }
        // Favorite Specific Book
        $book = Book::query()->inRandomOrder()->first();
        User::factory()
            ->count(11)
            ->create()
            ->each(function ($user) use ($book) {
                $user->favorites()->attach($book->id);
            });

        $response = $this->get('/api/books?sortBy=popularity');

        $response->dd();
        $response
            ->assertOk()
            ->assertJsonPath('data.0.id', $book->id);
    }

}
