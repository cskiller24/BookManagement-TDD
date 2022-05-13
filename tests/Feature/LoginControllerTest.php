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
        User::factory()->count(10)->create();
        User::factory()->create(['email' => 'duplicate@email.com']);

        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/api/login', [
                'email' => 'duplicate2@email.com',
                'password' => 'password'
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors']);
    }

    /**
     * @test
     */
    public function itLogsInUserSuccessfully(): void
    {
        User::factory()->count(10)->create();
        User::factory()->create(['email' => 'my_email@example.com']);

        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/api/login', [
                'email' => 'my_email@example.com',
                'password' => 'password'
            ]);

        $response->assertOk();
        // TO UPDATE \/\/\/\/\/
        $response->assertJsonStructure(['user', 'token']);
    }
}
