<?php

use App\Models\Story;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('the public story page is available and the home link points to it', function () {
    $story = Story::factory()->create(['title' => 'Comfort starts at home.']);

    $this->get(route('story'))->assertOk()->assertSee($story->title);
    $this->get(route('home'))->assertOk()->assertSee(route('story'), false);
});

test('authenticated users can update the story and upload its image', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $this->actingAs($user)->put(route('admin.story.update'), [
        'eyebrow' => 'Our promise',
        'title' => 'Comfort starts at home.',
        'intro' => 'We select every textile with daily living in mind.',
        'body' => 'Curtains Kenya helps Kenyan homes feel personal and practical.',
        'image' => UploadedFile::fake()->image('curtainskenya-story.jpg', 1200, 900),
        'image_alt' => 'Layered curtains in a welcoming living room',
    ])->assertRedirect(route('admin.story.edit'));

    $story = Story::query()->firstOrFail();
    $this->assertDatabaseHas('stories', ['title' => 'Comfort starts at home.']);
    Storage::disk('public')->assertExists($story->image);
});
