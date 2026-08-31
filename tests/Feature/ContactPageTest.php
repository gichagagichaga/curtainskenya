<?php

use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

test('the contact page shows Curtains Kenya contact options', function () {
    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('hello@curtainskenya.com')
        ->assertSee('+254 720 373 737')
        ->assertSee('Chat on WhatsApp')
        ->assertSee('Facebook')
        ->assertSee('Instagram')
        ->assertSee('TikTok');
});

test('visitors can submit a contact enquiry', function () {
    Mail::fake();

    $this->post(route('contact.store'), [
        'name' => 'Amina Wanjiku',
        'email' => 'amina@example.com',
        'phone' => '+254 700 000 000',
        'subject' => 'Custom curtains',
        'message' => 'I would like a fabric consultation for my living room.',
    ])->assertRedirect(route('contact'))
        ->assertSessionHas('status');

    Mail::assertSent(ContactMessageMail::class, function (ContactMessageMail $mail): bool {
        return $mail->hasTo('hello@curtainskenya.com')
            && $mail->contactDetails['subject'] === 'Custom curtains';
    });

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Amina Wanjiku',
        'email' => 'amina@example.com',
        'subject' => 'Custom curtains',
        'responded_at' => null,
    ]);
});

test('contact enquiries require the essential details', function () {
    Mail::fake();

    $this->from(route('contact'))->post(route('contact.store'), [])
        ->assertRedirect(route('contact'))
        ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

    Mail::assertNothingSent();
});
