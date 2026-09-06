<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', Rule::exists('categories', 'id')->where('is_active', true)],
        ]);

        $categories = Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => fn ($query) => $query->where('is_active', true)->withCount([
                'products' => fn ($productQuery) => $productQuery->where('is_active', true),
            ])])
            ->withCount([
                'products' => fn ($query) => $query->where('is_active', true),
            ])
            ->orderBy('sort_order')
            ->get();

        $products = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', true)
            ->when($filters['q'] ?? null, function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%")
                        ->orWhere('color', 'like', "%{$search}%")
                        ->orWhere('short_description', 'like', "%{$search}%");
                });
            })
            ->when($filters['category'] ?? null, function ($query, int $categoryId): void {
                $categoryIds = Category::query()
                    ->whereKey($categoryId)
                    ->orWhere('parent_id', $categoryId)
                    ->pluck('id');

                $query->whereIn('category_id', $categoryIds);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('shop.index', compact('categories', 'products'));
    }

    public function category(Category $category): View
    {
        abort_unless($category->is_active, 404);

        $categories = Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => fn ($query) => $query->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        $categoryIds = $category->children()
            ->where('is_active', true)
            ->pluck('id')
            ->push($category->id);

        $products = Product::query()
            ->with(['category', 'images'])
            ->whereIn('category_id', $categoryIds)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('shop.category', compact('category', 'categories', 'products'));
    }
}
