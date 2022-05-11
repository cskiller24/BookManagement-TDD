<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

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
}
