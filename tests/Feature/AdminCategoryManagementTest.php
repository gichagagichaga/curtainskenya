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
    $user = User::factory()->create(['role' => User::ROLE_CATALOGUE_MANAGER]);

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
    $user = User::factory()->create(['role' => User::ROLE_CATALOGUE_MANAGER]);

    $this->actingAs($user)->from(route('admin.categories.create'))->post(route('admin.categories.store'), [
        'name' => 'Accessories',
        'sort_order' => -1,
    ])->assertRedirect(route('admin.categories.create'))->assertSessionHasErrors('sort_order');
});

test('authenticated users can create a subcategory', function () {
    $user = User::factory()->create(['role' => User::ROLE_CATALOGUE_MANAGER]);
    $parent = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);

    $response = $this->actingAs($user)->post(route('admin.categories.store'), [
        'name' => 'Sheer Curtains',
        'parent_id' => $parent->id,
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $subcategory = Category::where('name', 'Sheer Curtains')->firstOrFail();

    $response->assertRedirect(route('admin.categories.edit', $subcategory));
    expect($subcategory->parent->is($parent))->toBeTrue()
        ->and($parent->children()->whereKey($subcategory)->exists())->toBeTrue();
});

test('subcategories cannot be nested below other subcategories', function () {
    $user = User::factory()->create(['role' => User::ROLE_CATALOGUE_MANAGER]);
    $parent = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    $subcategory = Category::create(['name' => 'Sheers', 'slug' => 'sheers', 'parent_id' => $parent->id, 'is_active' => true]);

    $this->actingAs($user)->post(route('admin.categories.store'), [
        'name' => 'Voile Sheers',
        'parent_id' => $subcategory->id,
        'sort_order' => 1,
    ])->assertSessionHasErrors('parent_id');
});

test('categories with products cannot be deleted', function () {
    $user = User::factory()->create(['role' => User::ROLE_CATALOGUE_MANAGER]);
    $category = Category::create(['name' => 'Bedding', 'slug' => 'bedding', 'is_active' => true]);
    Product::create(['category_id' => $category->id, 'name' => 'Cotton Duvet Set', 'slug' => 'cotton-duvet-set', 'price' => 8200, 'stock_quantity' => 4, 'is_active' => true]);

    $this->actingAs($user)->from(route('admin.categories.edit', $category))->delete(route('admin.categories.destroy', $category))
        ->assertRedirect(route('admin.categories.edit', $category))
        ->assertSessionHas('error');

    $this->assertDatabaseHas('categories', ['id' => $category->id]);
});

test('categories with subcategories cannot be deleted', function () {
    $user = User::factory()->create(['role' => User::ROLE_CATALOGUE_MANAGER]);
    $parent = Category::create(['name' => 'Curtains', 'slug' => 'curtains', 'is_active' => true]);
    Category::create(['name' => 'Blackout Curtains', 'slug' => 'blackout-curtains', 'parent_id' => $parent->id, 'is_active' => true]);

    $this->actingAs($user)->delete(route('admin.categories.destroy', $parent))
        ->assertSessionHas('error');

    $this->assertDatabaseHas('categories', ['id' => $parent->id]);
});
