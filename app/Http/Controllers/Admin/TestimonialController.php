<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.testimonials.index', ['testimonials' => Testimonial::query()->orderBy('sort_order')->latest()->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        Testimonial::create($this->data($request));

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update($this->data($request));

        return redirect()->route('admin.testimonials.index')->with('status', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return back()->with('status', 'Testimonial deleted successfully.');
    }

    private function data(StoreTestimonialRequest|UpdateTestimonialRequest $request): array
    {
        return [...$request->safe()->except('is_published'), 'is_published' => $request->boolean('is_published')];
    }
}
