<?php

use App\Models\Testimonial;
use App\Models\User;

test('public testimonials page shows only published reviews', function () {
    Testimonial::create(['customer_name' => 'Amina', 'rating' => 5, 'review' => 'Beautiful curtains and excellent service.', 'is_published' => true]);
    Testimonial::create(['customer_name' => 'Private Customer', 'rating' => 4, 'review' => 'Not ready for public display.', 'is_published' => false]);

    $this->get(route('testimonials.index'))
        ->assertSee('Amina')
        ->assertDontSee('Private Customer');
});

test('content managers can publish a testimonial', function () {
    $user = User::factory()->create(['role' => User::ROLE_CONTENT_MANAGER]);

    $this->actingAs($user)->post(route('admin.testimonials.store'), [
        'customer_name' => 'Brian', 'location' => 'Nairobi', 'rating' => 5,
        'review' => 'A thoughtful and professional experience.', 'sort_order' => 1, 'is_published' => true,
    ])->assertRedirect(route('admin.testimonials.index'));

    $this->assertDatabaseHas('testimonials', ['customer_name' => 'Brian', 'is_published' => true]);
});
