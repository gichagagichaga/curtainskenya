<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests are redirected away from product management', function () {
    $this->get(route('admin.products.index'))->assertRedirect(route('login'));
});

test('product form groups active subcategories beneath their main category', function () {
    $user = User::factory()->create(['role' => User::ROLE_CATALOGUE_MANAGER]);
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $subcategory = Category::create(['name' => 'Shower Curtains', 'slug' => 'shower-curtains', 'parent_id' => $category->id, 'is_active' => true]);

    $this->actingAs($user)->get(route('admin.products.create'))
        ->assertOk()
        ->assertSee('<optgroup label="Curtains">', false)
        ->assertSee('Shower Curtains')
        ->assertSee('value="'.$subcategory->id.'"', false);
});

test('authenticated users can create a product with an image', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);

    $response = $this->actingAs($user)->post(route('admin.products.store'), [
        'category_id' => $category->id, 'name' => 'Linen Curtain Panel', 'sku' => 'CK-LIN-001',
        'price' => '6500.00', 'sale_price' => '5900.00', 'stock_quantity' => 12,
        'is_featured' => true, 'is_active' => true,
        'images' => [UploadedFile::fake()->image('linen-curtain.jpg', 1200, 1600)],
    ]);

    $product = Product::where('sku', 'CK-LIN-001')->firstOrFail();
    $response->assertRedirect(route('admin.products.edit', $product));
    $this->assertDatabaseHas('products', ['id' => $product->id, 'slug' => 'linen-curtain-panel', 'is_featured' => true, 'is_active' => true]);
    $image = ProductImage::where('product_id', $product->id)->firstOrFail();
    Storage::disk('public')->assertExists($image->image_path);
});

test('product validation rejects a sale price above its regular price', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Blinds', 'slug' => 'blinds', 'is_active' => true]);

    $this->actingAs($user)->from(route('admin.products.create'))->post(route('admin.products.store'), [
        'category_id' => $category->id, 'name' => 'Roller Blind', 'price' => '2500.00', 'sale_price' => '3000.00', 'stock_quantity' => 2,
    ])->assertRedirect(route('admin.products.create'))->assertSessionHasErrors('sale_price');
});

test('authenticated users can adjust a product stock quantity from the product list', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Fabrics', 'slug' => 'fabrics', 'is_active' => true]);
    $product = Product::create(['category_id' => $category->id, 'name' => 'Linen Fabric', 'slug' => 'linen-fabric', 'price' => 1200, 'stock_quantity' => 3, 'is_active' => true]);

    $this->actingAs($user)->patch(route('admin.products.stock.update', $product), ['stock_quantity' => 18])
        ->assertSessionHas('status');

    $this->assertDatabaseHas('products', ['id' => $product->id, 'stock_quantity' => 18]);
});

test('product stock adjustment cannot be negative', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Fabrics', 'slug' => 'fabrics', 'is_active' => true]);
    $product = Product::create(['category_id' => $category->id, 'name' => 'Cotton Fabric', 'slug' => 'cotton-fabric', 'price' => 900, 'stock_quantity' => 3, 'is_active' => true]);

    $this->actingAs($user)->from(route('admin.products.index'))
        ->patch(route('admin.products.stock.update', $product), ['stock_quantity' => -1])
        ->assertRedirect(route('admin.products.index'))
        ->assertSessionHasErrors('stock_quantity');
});

test('product list can filter low stock products and sort them by stock quantity', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    Product::create(['category_id' => $category->id, 'name' => 'Five Items', 'slug' => 'five-items', 'price' => 1000, 'stock_quantity' => 5, 'is_active' => true]);
    Product::create(['category_id' => $category->id, 'name' => 'Ten Items', 'slug' => 'ten-items', 'price' => 1000, 'stock_quantity' => 10, 'is_active' => true]);
    Product::create(['category_id' => $category->id, 'name' => 'Plenty of Items', 'slug' => 'plenty-of-items', 'price' => 1000, 'stock_quantity' => 20, 'is_active' => true]);

    $this->actingAs($user)->get(route('admin.products.index', ['stock' => 'low_stock', 'sort' => 'stock_high']))
        ->assertSeeInOrder(['Ten Items', 'Five Items'])
        ->assertDontSee('Plenty of Items');
});

test('product list can search by product name and filter by category', function () {
    $user = User::factory()->create();
    $curtains = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $bedding = Category::create(['name' => 'Bedding', 'slug' => 'bedding', 'is_active' => true]);
    Product::create(['category_id' => $curtains->id, 'name' => 'Linen Curtain', 'slug' => 'linen-curtain', 'price' => 1000, 'stock_quantity' => 20, 'is_active' => true]);
    Product::create(['category_id' => $bedding->id, 'name' => 'Linen Duvet', 'slug' => 'linen-duvet', 'price' => 1000, 'stock_quantity' => 20, 'is_active' => true]);

    $this->actingAs($user)->get(route('admin.products.index', ['search' => 'Curtain', 'category' => $curtains->id]))
        ->assertSee('Linen Curtain')
        ->assertDontSee('Linen Duvet');
});

test('the product edit screen includes a full-size image preview', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $product = Product::create(['category_id' => $category->id, 'name' => 'Velvet Curtain', 'slug' => 'velvet-curtain', 'price' => 7200, 'stock_quantity' => 3, 'is_active' => true]);
    ProductImage::create(['product_id' => $product->id, 'image_path' => 'products/velvet-curtain.jpg']);

    $this->actingAs($user)->get(route('admin.products.edit', $product))
        ->assertOk()
        ->assertSee('Click an image to enlarge')
        ->assertSee('Product image preview');
});

test('deleting a product removes its uploaded images', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Bedding', 'slug' => 'bedding', 'is_active' => true]);
    $product = Product::create(['category_id' => $category->id, 'name' => 'Cotton Duvet Set', 'slug' => 'cotton-duvet-set', 'price' => 8200, 'stock_quantity' => 4, 'is_active' => true]);
    $image = ProductImage::create(['product_id' => $product->id, 'image_path' => 'products/cotton-duvet.jpg']);
    Storage::disk('public')->put($image->image_path, 'image-content');

    $this->actingAs($user)->delete(route('admin.products.destroy', $product))->assertRedirect(route('admin.products.index'));
    $this->assertDatabaseMissing('products', ['id' => $product->id]);
    $this->assertDatabaseMissing('product_images', ['id' => $image->id]);
    Storage::disk('public')->assertMissing($image->image_path);
});
