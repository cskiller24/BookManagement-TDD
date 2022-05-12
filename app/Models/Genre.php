<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    use HasFactory;

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
}
