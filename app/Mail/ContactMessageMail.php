<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, phone?: string|null, subject: string, message: string}  $contactDetails
     */
    public function __construct(public array $contactDetails) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Curtains Kenya enquiry: '.$this->contactDetails['subject'],
            replyTo: [new Address($this->contactDetails['email'], $this->contactDetails['name'])],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact-message',
        );
    }
}
