<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceQuoteRequest;
use App\Models\ContactMessage;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function show(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $service->load('images');

        return view('services.show', compact('service'));
    }

    public function quote(StoreServiceQuoteRequest $request, Service $service): RedirectResponse
    {
        abort_unless($service->is_active, 404);

        ContactMessage::create([...$request->validated(), 'subject' => "Quotation request: {$service->name}"]);

        return back()->with('status', 'Thank you. We will prepare your quotation and get back to you soon.');
    }
}
