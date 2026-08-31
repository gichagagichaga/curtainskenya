<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        return response()
            ->view('seo.sitemap', [
                'posts' => Post::query()->published()->latest('updated_at')->get(['id', 'slug', 'updated_at']),
                'blogCategories' => BlogCategory::query()->where('is_active', true)->whereHas('posts', fn ($posts) => $posts->published())->get(['id', 'slug', 'updated_at']),
                'shopCategories' => Category::query()->where('is_active', true)->get(['id', 'slug', 'updated_at']),
                'products' => Product::query()->where('is_active', true)->get(['id', 'slug', 'updated_at']),
                'services' => Service::query()->where('is_active', true)->get(['id', 'slug', 'updated_at']),
            ])
            ->header('Content-Type', 'application/xml');
    }
}
