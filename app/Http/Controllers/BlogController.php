<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::query()->published()->with(['category', 'author', 'tags']);
        $search = trim($request->string('q')->toString());

        if ($search !== '') {
            $query->where(function ($posts) use ($search): void {
                $posts->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%")
                    ->orWhere('seo_keywords', 'like', "%{$search}%");
            });
        }

        return view('blog.index', [
            'posts' => $query->latest('published_at')->paginate(9)->withQueryString(),
            'featuredPost' => $search === '' ? Post::query()->published()->with(['category', 'author'])->latest('published_at')->first() : null,
            'categories' => BlogCategory::query()->where('is_active', true)->withCount(['posts' => fn ($posts) => $posts->published()])->orderBy('name')->get(),
            'tags' => Tag::query()->whereHas('posts', fn ($posts) => $posts->published())->withCount(['posts' => fn ($posts) => $posts->published()])->orderByDesc('posts_count')->limit(12)->get(),
            'search' => $search,
        ]);
    }

    public function category(BlogCategory $blogCategory): View
    {
        abort_unless($blogCategory->is_active, 404);

        return view('blog.archive', [
            'heading' => $blogCategory->seo_title ?: $blogCategory->name.' articles',
            'description' => $blogCategory->meta_description ?: $blogCategory->description,
            'robots' => $blogCategory->noindex ? 'noindex,follow' : 'index,follow',
            'posts' => $blogCategory->posts()->published()->with(['category', 'author', 'tags'])->latest('published_at')->paginate(9),
            'categories' => BlogCategory::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function tag(Tag $tag): View
    {
        return view('blog.archive', [
            'heading' => 'Articles tagged '.$tag->name,
            'description' => 'Helpful Curtains Kenya guides about '.$tag->name.'.',
            'robots' => $tag->noindex ? 'noindex,follow' : 'index,follow',
            'posts' => $tag->posts()->published()->with(['category', 'author', 'tags'])->latest('published_at')->paginate(9),
            'categories' => BlogCategory::query()->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function show(Post $post): View
    {
        abort_unless($post->status === 'published' && $post->published_at?->isPast(), 404);

        $post->load(['author', 'category', 'tags', 'products.images', 'relatedPosts' => fn ($related) => $related->published()->with(['category', 'author'])]);
        $relatedPosts = $post->relatedPosts;

        if ($relatedPosts->isEmpty() && $post->blog_category_id) {
            $relatedPosts = Post::query()->published()->where('blog_category_id', $post->blog_category_id)->whereKeyNot($post->id)->with(['category', 'author'])->latest('published_at')->limit(3)->get();
        }

        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $post->seoDescription(),
            'image' => $post->imageUrl(),
            'author' => ['@type' => 'Person', 'name' => $post->author->name],
            'publisher' => ['@type' => 'Organization', 'name' => 'Curtains Kenya', 'url' => url('/')],
            'datePublished' => $post->published_at?->toAtomString(),
            'dateModified' => $post->updated_at->toAtomString(),
            'mainEntityOfPage' => $post->canonicalUrl(),
        ];
        $breadcrumbs = [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Journal', 'item' => route('blog.index')],
        ];

        if ($post->category) {
            $breadcrumbs[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $post->category->name, 'item' => route('blog.category', $post->category)];
        }

        $breadcrumbs[] = ['@type' => 'ListItem', 'position' => count($breadcrumbs) + 1, 'name' => $post->title, 'item' => $post->canonicalUrl()];
        $breadcrumbSchema = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $breadcrumbs];

        return view('blog.show', compact('post', 'relatedPosts', 'articleSchema', 'breadcrumbSchema'));
    }
}
