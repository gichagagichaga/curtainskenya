<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

test('the public product page includes an interactive image gallery', function () {
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $product = Product::create(['category_id' => $category->id, 'name' => 'Velvet Curtain', 'slug' => 'velvet-curtain', 'price' => 7200, 'stock_quantity' => 3, 'is_active' => true]);
    ProductImage::create(['product_id' => $product->id, 'image_path' => 'products/velvet-curtain-1.jpg', 'alt_text' => 'Velvet curtain front']);
    ProductImage::create(['product_id' => $product->id, 'image_path' => 'products/velvet-curtain-2.jpg', 'alt_text' => 'Velvet curtain detail', 'sort_order' => 1]);

    $this->get(route('products.show', $product))
        ->assertOk()
        ->assertSee('Hover to zoom and inspect fabric detail')
        ->assertDontSee('Full-size product image')
        ->assertSee('Velvet curtain detail');
});
