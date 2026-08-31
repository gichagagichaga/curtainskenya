<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()->with(['author', 'category'])->latest()->paginate(15);

        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.blog.posts.create', $this->formData());
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = DB::transaction(function () use ($request): Post {
            $post = Post::create($this->postData($request));
            $this->syncRelations($post, $request);

            return $post;
        });

        return redirect()->route('admin.blog.posts.edit', $post)->with('status', 'Article saved successfully.');
    }

    public function edit(Post $post): View
    {
        $post->load(['tags', 'products', 'relatedPosts']);

        return view('admin.blog.posts.edit', array_merge(['post' => $post], $this->formData($post)));
    }

    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $oldImage = $post->featured_image;

        DB::transaction(function () use ($request, $post): void {
            $post->update($this->postData($request, $post));
            $this->syncRelations($post, $request);
        });

        if ($request->hasFile('featured_image') && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.blog.posts.edit', $post)->with('status', 'Article updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $image = $post->featured_image;
        $post->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()->route('admin.blog.posts.index')->with('status', 'Article deleted successfully.');
    }

    private function formData(?Post $post = null): array
    {
        return [
            'categories' => BlogCategory::query()->orderBy('name')->get(),
            'tags' => Tag::query()->orderBy('name')->get(),
            'products' => Product::query()->where('is_active', true)->orderBy('name')->get(),
            'relatedPosts' => Post::query()->when($post, fn ($query) => $query->whereKeyNot($post->id))->orderBy('title')->get(),
        ];
    }

    private function postData(StorePostRequest|UpdatePostRequest $request, ?Post $post = null): array
    {
        $data = $request->safe()->except(['featured_image', 'tag_ids', 'product_ids', 'related_post_ids', 'noindex']);
        $data['author_id'] = $post?->author_id ?? $request->user()->id;
        $data['slug'] = $this->uniqueSlug($request->string('slug')->toString() ?: $data['title'], $post);
        $data['noindex'] = $request->boolean('noindex');
        $data['reading_time'] = max(1, (int) ceil(str_word_count(strip_tags($data['content'])) / 200));
        $data['published_at'] = $data['status'] === 'published' ? ($data['published_at'] ?? $post?->published_at ?? now()) : null;

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        return $data;
    }

    private function syncRelations(Post $post, StorePostRequest|UpdatePostRequest $request): void
    {
        $post->tags()->sync($request->input('tag_ids', []));
        $post->products()->sync($request->input('product_ids', []));
        $post->relatedPosts()->sync(array_values(array_diff($request->input('related_post_ids', []), [$post->id])));
    }

    private function uniqueSlug(string $value, ?Post $post = null): string
    {
        $baseSlug = Str::slug($value) ?: 'article';
        $slug = $baseSlug;
        $suffix = 2;

        while (Post::query()->where('slug', $slug)->when($post, fn ($query) => $query->whereKeyNot($post->id))->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }
}
