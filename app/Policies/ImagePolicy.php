<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\Image;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImagePolicy
{
    use HandlesAuthorization;

    public function belongsToBook(Book $book, Image $image): bool
    {
        return $book->id == $image->resource_id;
    }
}
