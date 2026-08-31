<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.clients.index', ['clients' => Client::query()->orderBy('sort_order')->orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        Client::create($this->data($request));

        return back()->with('status', 'Client added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $oldImage = $client->image;
        $client->update($this->data($request, $client));

        if ($request->hasFile('image') && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return back()->with('status', 'Client updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        $image = $client->image;
        $client->delete();
        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return back()->with('status', 'Client removed successfully.');
    }

    private function data(StoreClientRequest|UpdateClientRequest $request, ?Client $client = null): array
    {
        $data = [...$request->safe()->except(['is_active', 'image']), 'is_active' => $request->boolean('is_active')];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('clients', 'public');
        } elseif ($client) {
            $data['image'] = $client->image;
        }

        return $data;
    }
}
