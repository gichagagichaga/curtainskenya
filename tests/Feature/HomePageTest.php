<?php

use App\Models\Category;
use App\Models\Product;

test('renders active categories and featured products on the home page', function () {
    $category = Category::create([
        'name' => 'Curtains',
        'slug' => 'curtains',
        'description' => 'Drapery for every room.',
        'is_active' => true,
        'sort_order' => 1,
    ]);

    $featuredProduct = Product::create([
        'category_id' => $category->id,
        'name' => 'Soft Linen Curtain',
        'slug' => 'soft-linen-curtain',
        'sku' => 'CK-TEST-001',
        'short_description' => 'A tactile curtain.',
        'price' => 6500,
        'stock_quantity' => 5,
        'is_featured' => true,
        'is_active' => true,
    ]);

    $subcategory = Category::create([
        'name' => 'Sheer Curtains',
        'slug' => 'sheer-curtains',
        'parent_id' => $category->id,
        'is_active' => true,
        'sort_order' => 1,
    ]);

    Product::create([
        'category_id' => $category->id,
        'name' => 'Archived Curtain',
        'slug' => 'archived-curtain',
        'sku' => 'CK-TEST-002',
        'short_description' => 'Not available.',
        'price' => 5000,
        'stock_quantity' => 0,
        'is_featured' => true,
        'is_active' => false,
    ]);

    $this->get(route('home'))
        ->assertSee($category->name)
        ->assertSee($subcategory->name)
        ->assertSee($featuredProduct->name)
        ->assertSee(route('shop.category', $category), false)
        ->assertSee(route('shop.index'), false)
        ->assertSee(route('products.show', $featuredProduct), false)
        ->assertDontSee('Archived Curtain');
});
