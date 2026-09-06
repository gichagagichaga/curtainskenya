<?php

use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Database\Seeders\WhyChooseCurtainsKenyaSeeder;

test('the blog only lists published articles', function () {
    $published = Post::factory()->published()->create(['title' => 'Choosing curtains for a living room']);
    $draft = Post::factory()->create(['title' => 'Private curtain draft']);

    $this->get(route('blog.index'))
        ->assertOk()
        ->assertSee($published->title)
        ->assertDontSee($draft->title);
});

test('published articles show seo metadata and structured data', function () {
    $post = Post::factory()->published()->create([
        'title' => 'How to measure curtains',
        'slug' => 'how-to-measure-curtains',
        'faqs' => [[
            'question' => 'How wide should curtains be?',
            'answer' => 'Curtains should usually be one and a half to two times the track width.',
        ]],
    ]);

    $this->get(route('blog.show', $post))
        ->assertOk()
        ->assertSee('How to measure curtains | Curtains Kenya', false)
        ->assertSee('application/ld+json', false)
        ->assertSee('BlogPosting', false)
        ->assertSee('FAQPage', false)
        ->assertSee('How wide should curtains be?');
});

test('draft and scheduled articles return not found publicly', function () {
    $draft = Post::factory()->create();
    $scheduled = Post::factory()->create(['status' => 'published', 'published_at' => now()->addDay()]);

    $this->get(route('blog.show', $draft))->assertNotFound();
    $this->get(route('blog.show', $scheduled))->assertNotFound();
});

test('blog search and category and tag archives show relevant published articles', function () {
    $category = BlogCategory::factory()->create(['name' => 'Curtains', 'slug' => 'curtains']);
    $tag = Tag::factory()->create(['name' => 'Blackout curtains', 'slug' => 'blackout-curtains']);
    $post = Post::factory()->published()->create(['blog_category_id' => $category->id, 'title' => 'Blackout curtains for bedrooms']);
    $post->tags()->attach($tag);

    $this->get(route('blog.index', ['q' => 'Blackout']))->assertOk()->assertSee($post->title);
    $this->get(route('blog.category', $category))->assertOk()->assertSee($post->title);
    $this->get(route('blog.tag', $tag))->assertOk()->assertSee($post->title);
});

test('sitemap includes published articles and excludes drafts', function () {
    $published = Post::factory()->published()->create();
    $draft = Post::factory()->create();

    $this->get(route('sitemap'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml')
        ->assertSee($published->slug)
        ->assertDontSee($draft->slug);
});

test('the why choose curtains kenya cornerstone article is complete and public', function () {
    User::factory()->create([
        'email' => 'editor@curtainskenya.com',
        'role' => User::ROLE_CONTENT_MANAGER,
    ]);

    $this->seed(WhyChooseCurtainsKenyaSeeder::class);

    $post = Post::query()->where('slug', 'why-choose-curtains-kenya')->firstOrFail();

    expect(str_word_count(strip_tags($post->content)))
        ->toBeGreaterThanOrEqual(2000)
        ->and($post->status)->toBe('published')
        ->and($post->noindex)->toBeFalse()
        ->and($post->faqs)->toHaveCount(6);

    $this->get(route('blog.show', $post))
        ->assertOk()
        ->assertSee('Why Choose Curtains Kenya?')
        ->assertSee('curtain-measuring-consultation.webp', false)
        ->assertSee('FAQPage', false);
});
