<?php

namespace Tests;

use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    private function sanctumCreateUser(User $user ,array $abilities): Authenticatable
    {
        return Sanctum::actingAs($user, $abilities);
    }

    protected function actAsAdmin(User $user = null)
    {
        $abilities = Genre::ABILITIES;
        if(! $user) {
            return $this->sanctumCreateUser(User::factory()->create(['is_admin' => true]), $abilities);
        }
        return $this->sanctumCreateUser($user, $abilities);
    }

    protected function actAsUser(User $user = null)
    {
        $abilities = Book::ABILITIES;
        if($user == null) {
            return $this->sanctumCreateUser(User::factory()->create(), $abilities);
        }

        return $this->sanctumCreateUser($user, $abilities);
    }
}
