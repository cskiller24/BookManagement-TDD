<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
