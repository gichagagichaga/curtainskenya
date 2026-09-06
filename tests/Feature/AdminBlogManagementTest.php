<?php

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests cannot access blog management', function () {
    $this->get(route('admin.blog.posts.index'))->assertRedirect(route('login'));
});

test('article editor includes search and social seo controls', function () {
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $this->actingAs($user)->get(route('admin.blog.posts.create'))
        ->assertOk()
        ->assertSee('SEO and social sharing details')
        ->assertSee('name="canonical_url"', false)
        ->assertSee('name="og_title"', false)
        ->assertSee('data-markdown-before', false)
        ->assertSee('Frequently asked questions (SEO)')
        ->assertSee('name="faqs[0][question]"', false)
        ->assertSee('name="faqs[0][answer]"', false);
});

test('authenticated users can create an article with seo and a featured image', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);
    $category = BlogCategory::factory()->create();

    $response = $this->actingAs($user)->post(route('admin.blog.posts.store'), [
        'title' => 'How to choose curtains in Kenya',
        'blog_category_id' => $category->id,
        'excerpt' => 'A practical guide for selecting curtains.',
        'content' => "## Start with your room\n\nChoose fabric for the light you need.",
        'featured_image' => UploadedFile::fake()->image('living-room-curtains.jpg', 1200, 800),
        'featured_image_alt' => 'Warm curtains in a bright living room',
        'status' => 'published',
        'seo_title' => 'How to Choose Curtains in Kenya | Curtains Kenya',
        'meta_description' => 'Choose the right curtains for your Kenyan home with this practical guide.',
        'canonical_url' => 'https://curtainskenya.com/guides/choose-curtains',
        'og_title' => 'A Practical Kenyan Curtain Guide',
        'og_description' => 'Choose curtains for privacy, light control and style.',
        'faqs' => [
            ['question' => 'Which curtains are best for bedrooms?', 'answer' => 'Blackout-lined curtains provide privacy and reduce morning light.'],
            ['question' => '', 'answer' => ''],
        ],
    ]);

    $response->assertSessionHasNoErrors();

    $post = Post::where('title', 'How to choose curtains in Kenya')->firstOrFail();
    $response->assertRedirect(route('admin.blog.posts.edit', $post));
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'status' => 'published',
        'slug' => 'how-to-choose-curtains-in-kenya',
        'seo_title' => 'How to Choose Curtains in Kenya | Curtains Kenya',
    ]);
    expect($post->fresh()->faqs)->toBe([
        ['question' => 'Which curtains are best for bedrooms?', 'answer' => 'Blackout-lined curtains provide privacy and reduce morning light.'],
    ]);
    Storage::disk('public')->assertExists($post->featured_image);
});

test('article faq requires a complete question and answer pair', function () {
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $this->actingAs($user)->post(route('admin.blog.posts.store'), [
        'title' => 'Curtain care guide',
        'content' => 'Useful curtain care advice.',
        'status' => 'draft',
        'faqs' => [['question' => 'How often should curtains be cleaned?', 'answer' => '']],
    ])->assertSessionHasErrors('faqs.0.answer');
});

test('blog categories create independently from shop categories', function () {
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $this->actingAs($user)->post(route('admin.blog.categories.store'), [
        'name' => 'Interior décor',
        'description' => 'Helpful ideas for every room.',
        'is_active' => true,
    ])->assertRedirect();

    $this->assertDatabaseHas('blog_categories', ['name' => 'Interior décor', 'slug' => 'interior-decor']);
});
