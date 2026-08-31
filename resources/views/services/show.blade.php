@extends('layouts.public')

@section('title', $service->name.' | Curtains Kenya Services')
@section('description', $service->short_description ?: Str::limit($service->description, 155))

@section('content')
    <section class="bg-[#f3eee7] py-16 sm:py-24">
        <div @class(['ck-container grid items-center gap-10 lg:grid-cols-2 lg:gap-16' => $service->images->isNotEmpty(), 'ck-container max-w-4xl text-center' => $service->images->isEmpty()])>
            <div @class(['lg:order-2' => $service->images->isNotEmpty()])>
                <p class="text-[0.65rem] font-medium tracking-[0.22em] text-ck-brown uppercase">Curtains Kenya services</p>
                <h1 class="mt-5 font-serif text-4xl leading-tight tracking-[-0.045em] sm:text-6xl">{{ $service->name }}</h1>
                @if($service->short_description)<p @class(['mt-6 max-w-2xl text-base leading-8 text-ck-dark/70', 'mx-auto' => $service->images->isEmpty()])>{{ $service->short_description }}</p>@endif
            </div>
            @if($service->images->isNotEmpty())
                <div x-data="{ active: 0, total: {{ $service->images->count() }}, timer: null, init() { this.timer = setInterval(() => this.next(), 4500) }, next() { this.active = (this.active + 1) % this.total }, previous() { this.active = (this.active - 1 + this.total) % this.total }, pause() { clearInterval(this.timer) }, resume() { this.pause(); this.timer = setInterval(() => this.next(), 4500) } }" x-on:mouseenter="pause()" x-on:mouseleave="resume()" class="relative overflow-hidden rounded-2xl shadow-lg">
                    <div class="h-72 sm:h-96">
                        @foreach($service->images as $index => $image)
                            <img x-cloak x-show="active === {{ $index }}" x-transition.opacity src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $service->name }} — image {{ $index + 1 }}" class="h-full w-full object-cover">
                        @endforeach
                    </div>
                    @if($service->images->count() > 1)
                        <button type="button" x-on:click="previous(); resume()" class="absolute left-3 top-1/2 -translate-y-1/2 rounded-full bg-white/85 px-3 py-2 text-ck-dark shadow transition hover:bg-white" aria-label="Previous image">←</button>
                        <button type="button" x-on:click="next(); resume()" class="absolute right-3 top-1/2 -translate-y-1/2 rounded-full bg-white/85 px-3 py-2 text-ck-dark shadow transition hover:bg-white" aria-label="Next image">→</button>
                        <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 gap-2">@foreach($service->images as $index => $image)<button type="button" x-on:click="active = {{ $index }}; resume()" :class="active === {{ $index }} ? 'bg-white' : 'bg-white/50'" class="size-2.5 rounded-full" aria-label="Show image {{ $index + 1 }}"></button>@endforeach</div>
                    @endif
                </div>
            @endif
        </div>
    </section>
    <section class="ck-container grid gap-12 py-16 lg:grid-cols-[1.1fr_0.9fr] lg:py-24">
        <article class="max-w-2xl"><h2 class="font-serif text-3xl tracking-[-0.04em]">How we can help</h2><div class="mt-6 whitespace-pre-line text-base leading-8 text-ck-dark/75">{{ $service->description }}</div><a href="{{ route('contact') }}" class="mt-10 inline-flex items-center border-b border-ck-dark pb-1 text-[0.7rem] font-medium tracking-[0.14em] uppercase">Talk to our team <span class="ml-4">↗</span></a></article>
        <aside class="rounded-2xl bg-ck-dark p-7 text-white sm:p-9"><p class="text-[0.65rem] font-medium tracking-[0.2em] text-white/60 uppercase">Request a quotation</p><h2 class="mt-3 font-serif text-3xl tracking-[-0.04em]">Let’s discuss your space.</h2><p class="mt-4 text-sm leading-7 text-white/65">Tell us what you need and our team will get back to you with a tailored quotation.</p>@if(session('status'))<div class="mt-6 rounded-lg bg-white/15 px-4 py-3 text-sm text-white">{{ session('status') }}</div>@endif<form method="POST" action="{{ route('services.quote', $service) }}" class="mt-7 space-y-4">@csrf<div><label for="name" class="text-sm">Your name</label><input id="name" name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-lg border-0 bg-white px-3 py-3 text-sm text-ck-dark placeholder:text-zinc-400 focus:ring-2 focus:ring-ck-brown">@error('name')<p class="mt-1 text-xs text-red-200">{{ $message }}</p>@enderror</div><div><label for="email" class="text-sm">Email address</label><input id="email" type="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-lg border-0 bg-white px-3 py-3 text-sm text-ck-dark placeholder:text-zinc-400 focus:ring-2 focus:ring-ck-brown">@error('email')<p class="mt-1 text-xs text-red-200">{{ $message }}</p>@enderror</div><div><label for="phone" class="text-sm">Phone number <span class="text-white/55">(optional)</span></label><input id="phone" name="phone" value="{{ old('phone') }}" class="mt-2 w-full rounded-lg border-0 bg-white px-3 py-3 text-sm text-ck-dark placeholder:text-zinc-400 focus:ring-2 focus:ring-ck-brown">@error('phone')<p class="mt-1 text-xs text-red-200">{{ $message }}</p>@enderror</div><div><label for="message" class="text-sm">What do you need?</label><textarea id="message" name="message" rows="5" required class="mt-2 w-full rounded-lg border-0 bg-white px-3 py-3 text-sm text-ck-dark placeholder:text-zinc-400 focus:ring-2 focus:ring-ck-brown" placeholder="Share your measurements, preferred fabric, project type, or any questions.">{{ old('message') }}</textarea>@error('message')<p class="mt-1 text-xs text-red-200">{{ $message }}</p>@enderror</div><button class="w-full rounded-lg bg-white px-5 py-3 text-[0.7rem] font-semibold tracking-[0.14em] text-ck-dark uppercase transition hover:bg-[#f3eee7]">Request quotation</button></form></aside>
    </section>
@endsection
