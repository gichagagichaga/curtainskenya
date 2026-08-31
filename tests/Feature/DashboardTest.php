<?php

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    Category::create(['name' => 'Archived', 'slug' => 'archived', 'is_active' => false]);
    Product::create(['category_id' => $category->id, 'name' => 'Linen Curtain', 'slug' => 'linen-curtain', 'price' => 6500, 'stock_quantity' => 2, 'is_active' => true]);
    Product::create(['category_id' => $category->id, 'name' => 'Hidden Curtain', 'slug' => 'hidden-curtain', 'price' => 6500, 'stock_quantity' => 2, 'is_active' => false]);
    Post::factory()->published()->create(['author_id' => $user->id]);
    Post::factory()->create(['author_id' => $user->id]);
    ContactMessage::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk()
        ->assertSee('Products')
        ->assertSee('1 active in the shop')
        ->assertSee('Categories')
        ->assertSee('1 visible in the shop')
        ->assertSee('Blog')
        ->assertSee('1 draft article')
        ->assertSee('Customer enquiries')
        ->assertSee('awaiting a response');
});
