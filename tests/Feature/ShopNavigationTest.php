<?php

use App\Models\Category;
use App\Models\Product;

test('shop views provide links back to the home page', function () {
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    Product::create(['category_id' => $category->id, 'name' => 'Linen Curtain', 'slug' => 'linen-curtain', 'price' => 6500, 'stock_quantity' => 2, 'is_active' => true]);

    $this->get(route('shop.index'))
        ->assertOk()
        ->assertSee('← Home')
        ->assertSee('data-shop-product-grid', false)
        ->assertSee('data-shop-product-card', false)
        ->assertSee('data-shop-filters', false)
        ->assertSee('grid-template-columns: 7rem minmax(0, 1fr)', false)
        ->assertSee('Subcategory')
        ->assertSee('Min price')
        ->assertSee('Max price')
        ->assertSee('grid-cols-2', false)
        ->assertSee('sm:grid-cols-2', false)
        ->assertSee(route('home'), false);

    $this->get(route('shop.category', $category))
        ->assertOk()
        ->assertSee('← Home')
        ->assertSee('data-shop-product-grid', false)
        ->assertSee('data-shop-product-card', false)
        ->assertSee('grid-cols-3', false)
        ->assertSee('sm:grid-cols-2', false)
        ->assertSee(route('home'), false);
});

test('a main category displays its subcategories and their products', function () {
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $subcategory = Category::create(['name' => 'Blackout Curtains', 'slug' => 'blackout-curtains', 'parent_id' => $category->id, 'is_active' => true]);
    $product = Product::create(['category_id' => $subcategory->id, 'name' => 'Hotel Blackout Curtain', 'slug' => 'hotel-blackout-curtain', 'price' => 8500, 'stock_quantity' => 3, 'is_active' => true]);

    $this->get(route('shop.category', $category))
        ->assertOk()
        ->assertSee('data-category-menu="curtains"', false)
        ->assertSee('View all Curtains')
        ->assertSee($subcategory->name)
        ->assertSee(route('shop.category', $subcategory), false)
        ->assertSee($product->name);
});

test('the mobile header provides collapsed navigation and category product search', function () {
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $subcategory = Category::create(['name' => 'Sheers', 'slug' => 'sheers', 'parent_id' => $category->id, 'is_active' => true]);

    $this->get(route('shop.index'))
        ->assertSee('aria-label="Open navigation"', false)
        ->assertSee('id="mobile-navigation"', false)
        ->assertSee('id="mobile-shop-search"', false)
        ->assertSee('value="'.$subcategory->id.'"', false);
});

test('shop search filters products by text and category', function () {
    $curtains = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $sheers = Category::create(['name' => 'Sheers', 'slug' => 'sheers', 'parent_id' => $curtains->id, 'is_active' => true]);
    $bedding = Category::create(['name' => 'Bedding', 'slug' => 'bedding', 'is_active' => true]);
    Product::create(['category_id' => $sheers->id, 'name' => 'White Voile Curtain', 'slug' => 'white-voile-curtain', 'color' => 'White', 'price' => 5000, 'stock_quantity' => 2, 'is_active' => true]);
    Product::create(['category_id' => $bedding->id, 'name' => 'White Cotton Duvet', 'slug' => 'white-cotton-duvet', 'color' => 'White', 'price' => 7000, 'stock_quantity' => 2, 'is_active' => true]);

    $this->get(route('shop.index', ['q' => 'White', 'category' => $curtains->id]))
        ->assertSee('White Voile Curtain')
        ->assertDontSee('White Cotton Duvet');
});

test('shop filters products by subcategory and effective selling price', function () {
    $curtains = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $sheers = Category::create(['name' => 'Sheers', 'slug' => 'sheers', 'parent_id' => $curtains->id, 'is_active' => true]);
    $blackouts = Category::create(['name' => 'Blackouts', 'slug' => 'blackouts', 'parent_id' => $curtains->id, 'is_active' => true]);
    Product::create(['category_id' => $sheers->id, 'name' => 'Sale Voile', 'slug' => 'sale-voile', 'price' => 6000, 'sale_price' => 4500, 'stock_quantity' => 2, 'is_active' => true]);
    Product::create(['category_id' => $sheers->id, 'name' => 'Budget Voile', 'slug' => 'budget-voile', 'price' => 3000, 'stock_quantity' => 2, 'is_active' => true]);
    Product::create(['category_id' => $blackouts->id, 'name' => 'Midrange Blackout', 'slug' => 'midrange-blackout', 'price' => 4500, 'stock_quantity' => 2, 'is_active' => true]);

    $this->get(route('shop.index', [
        'category' => $curtains->id,
        'subcategory' => $sheers->id,
        'min_price' => 4000,
        'max_price' => 5000,
    ]))
        ->assertSee('Sale Voile')
        ->assertDontSee('Budget Voile')
        ->assertDontSee('Midrange Blackout');
});

test('shop rejects a maximum price below the minimum price', function () {
    $this->from(route('shop.index'))->get(route('shop.index', [
        'min_price' => 5000,
        'max_price' => 4000,
    ]))
        ->assertRedirect(route('shop.index'))
        ->assertSessionHasErrors('max_price');
});
