<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Service;
use App\Models\Story;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => fn ($query) => $query->where('is_active', true)])
            ->orderBy('sort_order')
            ->get();

        $featuredProducts = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        return view('home', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'services' => Service::query()->with('images')->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
            'story' => Story::query()->first(),
            'testimonials' => Testimonial::query()->where('is_published', true)->orderBy('sort_order')->latest()->get(),
            'clients' => Client::query()->where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }
}
