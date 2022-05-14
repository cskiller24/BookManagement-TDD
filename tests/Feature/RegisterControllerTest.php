<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function itReturnsFailValidationRequest(): void
    {
        User::factory()->create(['email' => 'user@example.org']);
        User::factory()->count(10)->create();

        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            'name' => 'My name',
            'email' => 'user@example.org',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors']);
    }

    /**
     * @test
     */
    public function itRegistersUserSuccessfully(): void
    {
        User::factory()->count(10)->create();
        $response = $this
            ->withHeaders(['Accept' => 'application/json'])
            ->post('/api/register', [
            'name' => 'My name',
            'email' => 'user@example.org',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertCreated();
    }
}
