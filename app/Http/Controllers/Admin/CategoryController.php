<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->with('parent')
            ->withCount(['products', 'children'])
            ->orderByRaw('parent_id is not null')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.categories.create', [
            'parentCategories' => $this->parentCategories(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $category = Category::create($this->categoryData($request));

        if ($request->hasFile('image')) {
            $category->update(['image' => $request->file('image')->store('categories', 'public')]);
        }

        return redirect()->route('admin.categories.edit', $category)->with('status', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'parentCategories' => $this->parentCategories($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $oldImagePath = $category->image;
        $category->update($this->categoryData($request, $category));

        if ($request->hasFile('image')) {
            $category->update(['image' => $request->file('image')->store('categories', 'public')]);

            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        return redirect()->route('admin.categories.edit', $category)->with('status', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'This category cannot be deleted while it still has products. Move or delete those products first.');
        }

        if ($category->children()->exists()) {
            return back()->with('error', 'This category cannot be deleted while it still has subcategories. Move or delete those subcategories first.');
        }

        $imagePath = $category->image;
        $category->delete();

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        return redirect()->route('admin.categories.index')->with('status', 'Category deleted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function categoryData(StoreCategoryRequest|UpdateCategoryRequest $request, ?Category $category = null): array
    {
        $data = $request->safe()->except(['image', 'is_active']);
        $data['slug'] = $this->uniqueSlug($data['name'], $category);
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function uniqueSlug(string $name, ?Category $category = null): string
    {
        $baseSlug = Str::slug($name) ?: 'category';
        $slug = $baseSlug;
        $suffix = 2;

        while (Category::query()->where('slug', $slug)->when($category, fn ($query) => $query->whereKeyNot($category->id))->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }

    /**
     * @return Collection<int, Category>
     */
    private function parentCategories(?Category $category = null): Collection
    {
        return Category::query()
            ->whereNull('parent_id')
            ->when($category, fn ($query) => $query->whereKeyNot($category->id))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
