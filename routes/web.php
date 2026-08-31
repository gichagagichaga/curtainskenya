<?php

use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\StoryController as AdminStoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');
Route::get('/our-story', StoryController::class)->name('story');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{blogCategory:slug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{tag:slug}', [BlogController::class, 'tag'])->name('blog.tag');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/robots.txt', fn () => response("User-agent: *\nAllow: /\nSitemap: ".route('sitemap')."\n", 200, ['Content-Type' => 'text/plain']))->name('robots');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

Route::get('/shop/{category:slug}', [ShopController::class, 'category'])
    ->name('shop.category');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order-confirmed/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::post('/services/{service:slug}/quote', [ServiceController::class, 'quote'])->middleware('throttle:5,1')->name('services.quote');

Route::get('/product/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)->middleware('role:orders_manager,customer_service,catalogue_manager,content_manager')->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('users', [AdminUserController::class, 'index'])->middleware('role:super_admin')->name('users.index');
        Route::post('users', [AdminUserController::class, 'store'])->middleware('role:super_admin')->name('users.store');
        Route::patch('users/{user}/role', [AdminUserController::class, 'update'])->middleware('role:super_admin')->name('users.update');
        Route::get('orders', [AdminOrderController::class, 'index'])->middleware('role:orders_manager')->name('orders.index');
        Route::patch('orders/{order}', [AdminOrderController::class, 'update'])->middleware('role:orders_manager')->name('orders.update');
        Route::get('enquiries', [ContactMessageController::class, 'index'])->middleware('role:customer_service')->name('enquiries.index');
        Route::patch('enquiries/{contactMessage}/responded', [ContactMessageController::class, 'markResponded'])->middleware('role:customer_service')->name('enquiries.responded');
        Route::patch('enquiries/{contactMessage}/new', [ContactMessageController::class, 'markNew'])->middleware('role:customer_service')->name('enquiries.new');
        Route::get('story', [AdminStoryController::class, 'edit'])->middleware('role:content_manager')->name('story.edit');
        Route::put('story', [AdminStoryController::class, 'update'])->middleware('role:content_manager')->name('story.update');
        Route::resource('blog/posts', BlogPostController::class)->middleware('role:content_manager')->names('blog.posts')->except('show');
        Route::resource('blog/categories', BlogCategoryController::class)->middleware('role:content_manager')->names('blog.categories')->except('show');
        Route::resource('blog/tags', TagController::class)->middleware('role:content_manager')->names('blog.tags')->except('show');
        Route::resource('testimonials', AdminTestimonialController::class)->middleware('role:content_manager')->except('show');
        Route::delete('services/{service}/images/{image}', [AdminServiceController::class, 'destroyImage'])->middleware('role:content_manager')->name('services.images.destroy');
        Route::resource('services', AdminServiceController::class)->middleware('role:content_manager')->except('show');
        Route::get('clients', [AdminClientController::class, 'index'])->middleware('role:content_manager')->name('clients.index');
        Route::post('clients', [AdminClientController::class, 'store'])->middleware('role:content_manager')->name('clients.store');
        Route::patch('clients/{client}', [AdminClientController::class, 'update'])->middleware('role:content_manager')->name('clients.update');
        Route::delete('clients/{client}', [AdminClientController::class, 'destroy'])->middleware('role:content_manager')->name('clients.destroy');
        Route::resource('categories', AdminCategoryController::class)->middleware('role:catalogue_manager')->except('show');

        Route::delete('products/{product}/images/{image}', [AdminProductController::class, 'destroyImage'])
            ->middleware('role:catalogue_manager')
            ->name('products.images.destroy');
        Route::patch('products/{product}/stock', [AdminProductController::class, 'updateStock'])
            ->middleware('role:catalogue_manager')
            ->name('products.stock.update');

        Route::resource('products', AdminProductController::class)->middleware('role:catalogue_manager')->except('show');
    });
});

require __DIR__.'/settings.php';
