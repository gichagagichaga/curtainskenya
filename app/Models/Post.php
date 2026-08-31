<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $fillable = [
        'author_id',
        'blog_category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'featured_image_alt',
        'status',
        'published_at',
        'reading_time',
        'seo_title',
        'meta_description',
        'seo_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'noindex',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'reading_time' => 'integer',
            'noindex' => 'boolean',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function relatedPosts(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'post_related_post', 'post_id', 'related_post_id')->withTimestamps();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')->where('published_at', '<=', now());
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function seoTitle(): string
    {
        return $this->seo_title ?: $this->title.' | Curtains Kenya';
    }

    public function seoDescription(): string
    {
        return $this->meta_description ?: Str::limit($this->excerpt ?: Str::stripTags($this->content), 160);
    }

    public function canonicalUrl(): string
    {
        return $this->canonical_url ?: route('blog.show', $this);
    }

    public function imageUrl(): ?string
    {
        return $this->featured_image ? asset('storage/'.$this->featured_image) : null;
    }
}
