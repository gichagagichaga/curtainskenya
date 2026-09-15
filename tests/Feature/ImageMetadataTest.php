<?php

use App\Models\User;
use App\Support\BlogContent;
use App\Support\UploadedImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('uploads preserve original filenames without overwriting duplicates', function () {
    Storage::fake('public');
    $first = UploadedImage::store(UploadedFile::fake()->image('Green Curtains.jpg'), 'products');
    $second = UploadedImage::store(UploadedFile::fake()->image('Green Curtains.jpg'), 'products');
    expect(basename($first))->toBe('Green Curtains.jpg')->and($first)->not->toBe($second);
    Storage::disk('public')->assertExists([$first, $second]);
});

test('blog uploads return original filename and image metadata', function () {
    Storage::fake('public');
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);
    $response = $this->actingAs($user)->postJson(route('admin.blog.images.store'), [
        'image' => UploadedFile::fake()->image('green-curtains.jpg'),
        'alt' => 'Green curtains in a living room', 'title' => 'Green curtains', 'caption' => 'Made to measure in Kenya',
    ])->assertOk()->assertJsonPath('caption', 'Made to measure in Kenya')->assertJsonPath('alt', 'Green curtains in a living room');
    expect($response->json('url'))->toEndWith('/green-curtains.jpg');
});

test('media captions and video accessible titles survive sanitization', function () {
    $html = '<figure><iframe src="https://www.youtube.com/embed/abcdefghijk" title="How to hang curtains"></iframe><figcaption>Installation guide</figcaption></figure><figure><img src="https://curtainskenya.com/storage/example.jpg" alt="Green curtains" title="Curtains"><figcaption>Living room</figcaption></figure>';
    $clean = BlogContent::prepareForStorage($html);
    expect($clean)->toContain('title="How to hang curtains"', 'Installation guide', 'Living room', 'alt="Green curtains"');
});
