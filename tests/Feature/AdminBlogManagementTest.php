<?php

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests cannot access blog management', function () {
    $this->get(route('admin.blog.posts.index'))->assertRedirect(route('login'));
});

test('authenticated users can create an article with seo and a featured image', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $category = BlogCategory::factory()->create();

    $response = $this->actingAs($user)->post(route('admin.blog.posts.store'), [
        'title' => 'How to choose curtains in Kenya',
        'blog_category_id' => $category->id,
        'excerpt' => 'A practical guide for selecting curtains.',
        'content' => "## Start with your room\n\nChoose fabric for the light you need.",
        'featured_image' => UploadedFile::fake()->image('living-room-curtains.jpg', 1200, 800),
        'featured_image_alt' => 'Warm curtains in a bright living room',
        'status' => 'published',
        'meta_description' => 'Choose the right curtains for your Kenyan home with this practical guide.',
    ]);

    $post = Post::where('title', 'How to choose curtains in Kenya')->firstOrFail();
    $response->assertRedirect(route('admin.blog.posts.edit', $post));
    $this->assertDatabaseHas('posts', ['id' => $post->id, 'status' => 'published', 'slug' => 'how-to-choose-curtains-in-kenya']);
    Storage::disk('public')->assertExists($post->featured_image);
});

test('blog categories create independently from shop categories', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('admin.blog.categories.store'), [
        'name' => 'Interior décor',
        'description' => 'Helpful ideas for every room.',
        'is_active' => true,
    ])->assertRedirect();

    $this->assertDatabaseHas('blog_categories', ['name' => 'Interior décor', 'slug' => 'interior-decor']);
});
