<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    /**
     * Use for storing in a public path
     *
     * @var string
     */
    const DISK = 'public_image';

    /**
     * Default image file name
     *
     * @var string
     */
    const DEFAULT_IMAGE = 'default_image.png';
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'path' => 'string',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'path',
    ];

    public function resource(): MorphTo
    {
        return $this->morphTo();
    }
}
