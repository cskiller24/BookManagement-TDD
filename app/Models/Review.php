<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    public const ABILITIES = [
        'review.create',
        'review.update',
        'review.delete'
    ];

    protected $table = 'reviews';

    protected $casts = [
        'star' => 'integer',
        'title' => 'string',
        'description' => 'string'
    ];

    protected $fillable = [
        'star',
        'title',
        'description'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
