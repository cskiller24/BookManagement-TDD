<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Book extends Model
{
    use HasFactory;

    public const ABILITIES = [
        'book.create',
        'book.update',
        'book.delete',
        'book.images-create',
        'book.images-delete',
        'book.images-update',
        'book.favorites-create',
        'book.favorites-delete'
    ];

    protected $table = 'books';

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
    ];

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'genre_id',
        'featured_image_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'resource');
    }

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'featured_image_id');
    }

    public function addRecommendation($book): ?self
    {
        $genre = $book->genre->id;

        return Book::inRandomOrder()
            ->where('genre_id', '=', $genre)
            ->whereNot('id', '=', $book->id)
            ->with('images')
            ->first();
    }

    public function addAverageReview(Book $book)
    {
        return $book->reviews()->avg('star');
    }

}
