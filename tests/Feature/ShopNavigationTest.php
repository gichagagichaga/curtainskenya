<?php

use App\Models\Category;
use App\Models\Product;

test('shop views provide links back to the home page', function () {
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    Product::create(['category_id' => $category->id, 'name' => 'Linen Curtain', 'slug' => 'linen-curtain', 'price' => 6500, 'stock_quantity' => 2, 'is_active' => true]);

    $this->get(route('shop.index'))
        ->assertOk()
        ->assertSee('← Home')
        ->assertSee(route('home'), false);

    $this->get(route('shop.category', $category))
        ->assertOk()
        ->assertSee('← Home')
        ->assertSee(route('home'), false);
});

test('a main category displays its subcategories and their products', function () {
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $subcategory = Category::create(['name' => 'Blackout Curtains', 'slug' => 'blackout-curtains', 'parent_id' => $category->id, 'is_active' => true]);
    $product = Product::create(['category_id' => $subcategory->id, 'name' => 'Hotel Blackout Curtain', 'slug' => 'hotel-blackout-curtain', 'price' => 8500, 'stock_quantity' => 3, 'is_active' => true]);

    $this->get(route('shop.category', $category))
        ->assertOk()
        ->assertSee($subcategory->name)
        ->assertSee(route('shop.category', $subcategory), false)
        ->assertSee($product->name);
});
