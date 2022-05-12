<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

    }

    /**
     * @test
     */
    public function itGeneratesFactory()
    {

        $genre = Genre::factory()->create();

        Book::factory()->for($genre)->count(3)->create();
        Book::factory()->create();

        $response = $this->get('/api/test');

        $response->dd();
    }
}
