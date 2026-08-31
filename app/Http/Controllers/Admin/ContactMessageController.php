<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::query()->latest()->paginate(20);

        return view('admin.enquiries.index', compact('messages'));
    }

    public function markResponded(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->update(['responded_at' => now()]);

        return back()->with('status', 'Enquiry marked as responded.');
    }

    public function markNew(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->update(['responded_at' => null]);

        return back()->with('status', 'Enquiry marked as awaiting a response.');
    }
}
