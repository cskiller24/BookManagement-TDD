<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'image' => 'string'
    ];

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
