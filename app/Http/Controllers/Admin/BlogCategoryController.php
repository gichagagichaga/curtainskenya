<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::query()->withCount('posts')->orderBy('name')->paginate(20);

        return view('admin.blog.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.blog.categories.create');
    }

    public function store(StoreBlogCategoryRequest $request): RedirectResponse
    {
        $category = BlogCategory::create($this->categoryData($request));

        return redirect()->route('admin.blog.categories.edit', $category)->with('status', 'Blog category created successfully.');
    }

    public function edit(BlogCategory $blogCategory): View
    {
        return view('admin.blog.categories.edit', compact('blogCategory'));
    }

    public function update(UpdateBlogCategoryRequest $request, BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->update($this->categoryData($request, $blogCategory));

        return redirect()->route('admin.blog.categories.edit', $blogCategory)->with('status', 'Blog category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory): RedirectResponse
    {
        $blogCategory->delete();

        return redirect()->route('admin.blog.categories.index')->with('status', 'Blog category deleted successfully.');
    }

    private function categoryData(StoreBlogCategoryRequest|UpdateBlogCategoryRequest $request, ?BlogCategory $category = null): array
    {
        $data = $request->safe()->except(['slug', 'noindex', 'is_active']);
        $data['slug'] = $this->uniqueSlug($request->string('slug')->toString() ?: $data['name'], $category);
        $data['noindex'] = $request->boolean('noindex');
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function uniqueSlug(string $value, ?BlogCategory $category = null): string
    {
        $baseSlug = Str::slug($value) ?: 'topic';
        $slug = $baseSlug;
        $suffix = 2;

        while (BlogCategory::query()->where('slug', $slug)->when($category, fn ($query) => $query->whereKeyNot($category->id))->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }
}
