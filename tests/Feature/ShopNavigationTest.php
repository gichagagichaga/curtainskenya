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
