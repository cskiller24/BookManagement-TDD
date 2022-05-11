<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_retrieves_users()
    {
        User::factory()->count(10)->create();

        $response = $this->get('/api/users');
        $response->assertOk();
        $response->assertJsonCount(10);

    }
}
