<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.services.index', ['services' => Service::query()->with('images')->orderBy('sort_order')->orderBy('name')->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $service = Service::create($this->data($request));
        $this->storeImages($service, $request->file('images', []));

        return redirect()->route('admin.services.edit', $service)->with('status', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service): View
    {
        $service->load('images');

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $service->update($this->data($request, $service));
        $this->storeImages($service, $request->file('images', []));

        return redirect()->route('admin.services.edit', $service)->with('status', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $imagePaths = [...$service->images()->pluck('image_path')->all(), $service->image];
        $service->delete();

        Storage::disk('public')->delete(array_filter(array_unique($imagePaths)));

        return back()->with('status', 'Service deleted successfully.');
    }

    public function destroyImage(Service $service, ServiceImage $image): RedirectResponse
    {
        abort_unless($image->service_id === $service->id, 404);

        $imagePath = $image->image_path;
        $image->delete();
        Storage::disk('public')->delete($imagePath);

        return back()->with('status', 'Service image removed successfully.');
    }

    private function data(StoreServiceRequest|UpdateServiceRequest $request, ?Service $service = null): array
    {
        $data = [...$request->safe()->except(['is_active', 'images']), 'is_active' => $request->boolean('is_active')];
        $data['slug'] = $this->uniqueSlug($data['name'], $service);

        return $data;
    }

    private function storeImages(Service $service, array $images): void
    {
        $sortOrder = (int) $service->images()->max('sort_order') + 1;

        foreach ($images as $image) {
            $service->images()->create([
                'image_path' => $image->store('services', 'public'),
                'sort_order' => $sortOrder++,
            ]);
        }
    }

    private function uniqueSlug(string $name, ?Service $service = null): string
    {
        $baseSlug = Str::slug($name) ?: 'service';
        $slug = $baseSlug;
        $suffix = 2;

        while (Service::query()->where('slug', $slug)->when($service, fn ($query) => $query->whereKeyNot($service->id))->exists()) {
            $slug = $baseSlug.'-'.$suffix++;
        }

        return $slug;
    }
}
