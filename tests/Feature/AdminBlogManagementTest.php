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
        ->assertSee('data-blog-editor', false)
        ->assertSee('data-editor-toolbar', false)
        ->assertSee('data-editor-preview-open', false)
        ->assertSee('data-editor-image-dialog', false)
        ->assertSee('data-editor-link-dialog', false)
        ->assertSee(route('admin.blog.images.store'), false)
        ->assertSee('Frequently asked questions (SEO)')
        ->assertSee('name="faqs[0][question]"', false)
        ->assertSee('name="faqs[0][answer]"', false);
});

test('rich article html is sanitized before it is stored and rendered', function () {
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $response = $this->actingAs($user)->post(route('admin.blog.posts.store'), [
        'title' => 'Safe rich article',
        'content' => '<h2>Useful heading</h2><p style="text-align:center" onclick="alert(1)"><strong>Helpful text</strong></p><script>alert(2)</script><img src="javascript:alert(3)" onerror="alert(4)" alt="Unsafe image">',
        'status' => 'published',
    ]);

    $post = Post::query()->where('title', 'Safe rich article')->firstOrFail();

    $response->assertRedirect(route('admin.blog.posts.edit', $post));
    expect($post->content)
        ->toContain('<h2>Useful heading</h2>')
        ->toContain('<strong>Helpful text</strong>')
        ->not->toContain('<script')
        ->not->toContain('onclick')
        ->not->toContain('onerror')
        ->not->toContain('javascript:');

    $this->get(route('blog.show', $post))
        ->assertOk()
        ->assertSee('<h2>Useful heading</h2>', false)
        ->assertDontSee('<script>alert(2)</script>', false)
        ->assertDontSee('javascript:alert(3)', false)
        ->assertDontSee('onerror="alert(4)"', false);
});

test('content managers can upload safe images into the rich text editor', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $response = $this->actingAs($user)->postJson(route('admin.blog.images.store'), [
        'image' => UploadedFile::fake()->image('curtain-guide.webp', 1200, 800),
        'alt' => 'Layered curtains in a bright living room',
        'title' => 'Layered curtain inspiration',
    ]);

    $path = str($response->json('url'))->after('/storage/')->toString();
    $response->assertOk()
        ->assertJsonPath('alt', 'Layered curtains in a bright living room')
        ->assertJsonPath('title', 'Layered curtain inspiration');
    Storage::disk('public')->assertExists($path);
});

test('unsafe rich text image uploads are rejected', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $this->actingAs($user)->postJson(route('admin.blog.images.store'), [
        'image' => UploadedFile::fake()->create('payload.svg', 20, 'image/svg+xml'),
        'alt' => 'Unsafe vector',
    ])->assertUnprocessable()->assertJsonValidationErrors('image');
});

test('rich text image uploads require an authorized content manager', function () {
    Storage::fake('public');

    $this->postJson(route('admin.blog.images.store'), [
        'image' => UploadedFile::fake()->image('curtains.jpg'),
        'alt' => 'Curtains',
    ])->assertUnauthorized();

    $user = User::factory()->create(['role' => User::ROLE_CATALOGUE_MANAGER]);

    $this->actingAs($user)->postJson(route('admin.blog.images.store'), [
        'image' => UploadedFile::fake()->image('curtains.jpg'),
        'alt' => 'Curtains',
    ])->assertForbidden();
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

test('content managers can define and assign a category while creating an article', function () {
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $response = $this->actingAs($user)->post(route('admin.blog.posts.store'), [
        'title' => 'Choosing bedroom curtains',
        'blog_category_name' => 'Bedroom curtain guides',
        'content' => '<p>Useful bedroom curtain advice.</p>',
        'status' => 'draft',
    ]);

    $category = BlogCategory::query()->where('name', 'Bedroom curtain guides')->firstOrFail();
    $post = Post::query()->where('title', 'Choosing bedroom curtains')->firstOrFail();

    $response->assertRedirect(route('admin.blog.posts.edit', $post));
    expect($category->slug)->toBe('bedroom-curtain-guides')
        ->and($category->is_active)->toBeTrue()
        ->and($post->blog_category_id)->toBe($category->id);
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
