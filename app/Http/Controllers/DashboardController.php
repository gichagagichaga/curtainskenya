<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('dashboard', [
            'productCount' => Product::query()->count(),
            'activeProductCount' => Product::query()->where('is_active', true)->count(),
            'categoryCount' => Category::query()->count(),
            'activeCategoryCount' => Category::query()->where('is_active', true)->count(),
            'publishedPostCount' => Post::query()->published()->count(),
            'draftPostCount' => Post::query()->where('status', 'draft')->count(),
            'newEnquiryCount' => ContactMessage::query()->whereNull('responded_at')->count(),
            'pendingOrderCount' => Order::query()->where('status', 'pending')->count(),
        ]);
    }
}
