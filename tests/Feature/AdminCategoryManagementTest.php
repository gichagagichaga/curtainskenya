<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests are redirected away from category management', function () {
    $this->get(route('admin.categories.index'))->assertRedirect(route('login'));
});

test('authenticated users can create a category with an image', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('admin.categories.store'), [
        'name' => 'Sheer Curtains',
        'description' => 'Light-filtering curtains for bright rooms.',
        'sort_order' => 3,
        'is_active' => true,
        'image' => UploadedFile::fake()->image('sheer-curtains.jpg', 1200, 900),
    ]);

    $category = Category::where('name', 'Sheer Curtains')->firstOrFail();
    $response->assertRedirect(route('admin.categories.edit', $category));
    $this->assertDatabaseHas('categories', ['id' => $category->id, 'slug' => 'sheer-curtains', 'sort_order' => 3, 'is_active' => true]);
    Storage::disk('public')->assertExists($category->image);
});

test('category validation requires a non-negative display order', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->from(route('admin.categories.create'))->post(route('admin.categories.store'), [
        'name' => 'Accessories',
        'sort_order' => -1,
    ])->assertRedirect(route('admin.categories.create'))->assertSessionHasErrors('sort_order');
});

test('categories with products cannot be deleted', function () {
    $user = User::factory()->create();
    $category = Category::create(['name' => 'Bedding', 'slug' => 'bedding', 'is_active' => true]);
    Product::create(['category_id' => $category->id, 'name' => 'Cotton Duvet Set', 'slug' => 'cotton-duvet-set', 'price' => 8200, 'stock_quantity' => 4, 'is_active' => true]);

    $this->actingAs($user)->from(route('admin.categories.edit', $category))->delete(route('admin.categories.destroy', $category))
        ->assertRedirect(route('admin.categories.edit', $category))
        ->assertSessionHas('error');

    $this->assertDatabaseHas('categories', ['id' => $category->id]);
});
