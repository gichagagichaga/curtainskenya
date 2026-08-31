<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::query()->where('is_published', true)->orderBy('sort_order')->latest()->get();

        return view('testimonials.index', compact('testimonials'));
    }
}
