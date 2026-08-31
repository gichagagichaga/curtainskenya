<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::query()->withCount('posts')->orderBy('name')->paginate(30);

        return view('admin.blog.tags.index', compact('tags'));
    }

    public function create(): View
    {
        return view('admin.blog.tags.create');
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        $tag = Tag::create($this->tagData($request));

        return redirect()->route('admin.blog.tags.edit', $tag)->with('status', 'Tag created successfully.');
    }

    public function edit(Tag $tag): View
    {
        return view('admin.blog.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag): RedirectResponse
    {
        $tag->update($this->tagData($request, $tag));

        return redirect()->route('admin.blog.tags.edit', $tag)->with('status', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->route('admin.blog.tags.index')->with('status', 'Tag deleted successfully.');
    }

    private function tagData(StoreTagRequest|UpdateTagRequest $request, ?Tag $tag = null): array
    {
        $data = $request->safe()->except(['slug', 'noindex']);
        $data['slug'] = $this->uniqueSlug($request->string('slug')->toString() ?: $data['name'], $tag);
        $data['noindex'] = $request->boolean('noindex');

        return $data;
    }

    private function uniqueSlug(string $value, ?Tag $tag = null): string
    {
        $baseSlug = Str::slug($value) ?: 'tag';
        $slug = $baseSlug;
        $suffix = 2;

        while (Tag::query()->where('slug', $slug)->when($tag, fn ($query) => $query->whereKeyNot($tag->id))->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }
}
