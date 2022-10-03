<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Genre extends Model
{
    use HasFactory;

    public const ABILITIES = [
        'genre.create',
        'genre.update',
        'genre.deactivate'
    ];

    protected $table = 'genres';

    protected $casts = [
        'title' => 'string',
        'type' => 'string',
        'description' => 'string'
    ];

    protected $fillable = [
        'title',
        'type',
        'description'
    ];

    public $timestamps = false;

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'resource');
    }

}
