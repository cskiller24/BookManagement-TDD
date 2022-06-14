<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function belongsToUser(User $user, Book $book): bool
    {
        return $user->id == $book->user_id;
    }
}