<?php

namespace App\Models;

use Database\Factories\BlogCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    /** @use HasFactory<BlogCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'seo_title',
        'meta_description',
        'noindex',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'noindex' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
