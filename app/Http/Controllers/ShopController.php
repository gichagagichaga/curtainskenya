<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->withCount([
                'products' => fn ($query) => $query->where('is_active', true),
            ])
            ->orderBy('sort_order')
            ->get();

        $products = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('shop.index', compact('categories', 'products'));
    }

    public function category(Category $category): View
    {
        abort_unless($category->is_active, 404);

        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $products = $category->products()
            ->with(['category', 'images'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('shop.category', compact('category', 'categories', 'products'));
    }
}
