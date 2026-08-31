<?php

use App\Models\ContactMessage;
use App\Models\User;

test('guests cannot view customer enquiries', function () {
    $this->get(route('admin.enquiries.index'))->assertRedirect(route('login'));
});

test('administrators can review and mark an enquiry as responded', function () {
    $user = User::factory()->create();
    $message = ContactMessage::factory()->create(['subject' => 'Need help with blinds']);

    $this->actingAs($user)->get(route('admin.enquiries.index'))
        ->assertOk()
        ->assertSee($message->subject)
        ->assertSee('Awaiting response');

    $this->actingAs($user)->patch(route('admin.enquiries.responded', $message))
        ->assertRedirect();

    $this->assertDatabaseMissing('contact_messages', ['id' => $message->id, 'responded_at' => null]);
});

test('responded enquiries can be marked as new again', function () {
    $user = User::factory()->create();
    $message = ContactMessage::factory()->create(['responded_at' => now()]);

    $this->actingAs($user)->patch(route('admin.enquiries.new', $message))->assertRedirect();

    $this->assertDatabaseHas('contact_messages', ['id' => $message->id, 'responded_at' => null]);
});
