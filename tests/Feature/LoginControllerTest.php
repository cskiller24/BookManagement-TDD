<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function itReturnsValidationErrorRequest(): void
    {
        User::factory()->create(['email' => 'duplicate@email.com']);

        $response = $this->postJson('/api/login', [
            'email' => 'duplicate2@example.com',
            'password' => 'password'
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);
    }

    /**
     * @test
     */
    public function itLogsInUserSuccessfully(): void
    {
        $user = User::factory()->create(['email' => 'my_email@example.com']);

        $response = $this->postJson('/api/login', [
            'email' => 'my_email@example.com',
            'password' => 'password'
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $user->id)
            ->assertJsonStructure(['token'], $response->json('data'));
    }
}
