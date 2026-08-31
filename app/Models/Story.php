<?php

namespace App\Models;

use Database\Factories\StoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    /** @use HasFactory<StoryFactory> */
    use HasFactory;

    protected $fillable = [
        'eyebrow',
        'title',
        'intro',
        'body',
        'image',
        'image_alt',
    ];
}
