<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

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
        'genre_id'
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
//            ->withPivot(['user_id', 'book_id'])
//            ->orderByRaw('COUNT(*) OVER (PARTITION BY book_id) DESC');
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
