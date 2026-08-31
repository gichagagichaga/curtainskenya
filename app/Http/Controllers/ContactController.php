<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactMessageRequest;
use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('contact');
    }

    public function store(SendContactMessageRequest $request): RedirectResponse
    {
        $contactDetails = $request->validated();
        ContactMessage::create($contactDetails);
        Mail::to('hello@curtainskenya.com')->send(new ContactMessageMail($contactDetails));

        return redirect()->route('contact')->with('status', 'Thank you for contacting Curtains Kenya. We will get back to you soon.');
    }
}
