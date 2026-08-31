@extends('layouts.public')

@section('title', 'Our Story | Curtains Kenya')
@section('description', $story?->intro ?: 'Discover the Curtains Kenya approach to thoughtful home textiles and beautifully lived-in spaces.')

@section('content')
<section class="bg-ck-cream py-14 sm:py-20"><div class="ck-container max-w-4xl"><p class="text-xs font-medium tracking-[0.18em] text-ck-brown uppercase">{{ $story?->eyebrow ?: 'The Curtains Kenya way' }}</p><h1 class="mt-4 font-serif text-4xl leading-tight sm:text-6xl">{{ $story?->title ?: 'The details change everything.' }}</h1><p class="mt-6 max-w-3xl text-lg leading-8 text-ck-brown">{{ $story?->intro ?: 'A room begins to feel like yours in its softest layers: the light through a curtain, the weight of a bedcover, a fabric that wears beautifully over time.' }}</p></div></section>
<section class="ck-container grid gap-10 py-14 sm:py-20 lg:grid-cols-2 lg:items-center lg:gap-20"><div class="aspect-[4/5] overflow-hidden bg-ck-beige">@if($story?->image)<img src="{{ asset('storage/'.$story->image) }}" alt="{{ $story->image_alt }}" class="size-full object-cover">@else<img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=85" alt="Warm, texture-led living space" class="size-full object-cover">@endif</div><div><p class="ck-eyebrow">Made for real homes</p><p class="font-serif text-3xl leading-tight sm:text-4xl">{{ $story?->body ?: 'We bring together practical pieces and lasting finishes so you can create a home that works hard and welcomes softly.' }}</p><a href="{{ route('contact') }}" class="ck-button mt-8">Talk to us <span class="ml-4">↗</span></a></div></section>
@endsection
