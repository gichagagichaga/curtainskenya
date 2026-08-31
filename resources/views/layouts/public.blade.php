<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Curtains Kenya | Made-to-Measure Curtains & Blinds')</title>

    <meta
        name="description"
        content="@yield('description', 'Shop and request installation for curtains, blinds, bedding and home textiles from Curtains Kenya.')"
    >
    @php($canonicalUrl = trim($__env->yieldContent('canonical')) ?: url()->current())
    @php($socialImage = trim($__env->yieldContent('og_image')) ?: asset('images/curtains-kenya-logo.png'))
    <meta name="robots" content="@yield('robots', 'index,follow')">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Curtains Kenya">
    <meta property="og:title" content="@yield('og_title', 'Curtains Kenya | Made-to-Measure Curtains & Blinds')">
    <meta property="og:description" content="@yield('og_description', 'Window styling, soft furnishings and installation support for Kenyan homes and businesses.')">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $socialImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Curtains Kenya | Made-to-Measure Curtains & Blinds')">
    <meta name="twitter:description" content="@yield('og_description', 'Window styling, soft furnishings and installation support for Kenyan homes and businesses.')">
    <meta name="twitter:image" content="{{ $socialImage }}">
    @php($organizationSchema = ['@'.'context' => 'https://schema.org', '@'.'type' => 'Organization', 'name' => 'Curtains Kenya', 'url' => config('app.url'), 'email' => 'hello@curtainskenya.com', 'logo' => asset('images/curtains-kenya-logo.png')])
    <script type="application/ld+json">{{ json_encode($organizationSchema, JSON_UNESCAPED_SLASHES) }}</script>
    @yield('structured_data')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-white text-ck-dark antialiased">
    @php($cartItemCount = array_sum(session('cart', [])))
    <div class="bg-ck-dark px-4 py-2.5 text-center text-[0.62rem] font-medium tracking-[0.22em] text-white uppercase sm:text-xs">
        Measured for your space <span class="mx-2 text-white/40">•</span> Delivery and fitting across Kenya
    </div>

    <header class="sticky top-0 z-30 border-b border-black/8 bg-white/95 backdrop-blur">
        <div class="ck-container flex min-h-20 items-center justify-between gap-5">
            <a href="{{ route('home') }}" class="group shrink-0" aria-label="Curtains Kenya home">
                <img src="{{ asset('images/curtains-kenya-logo.png') }}" alt="Curtains Kenya" class="h-14 w-auto max-w-44 object-contain sm:h-16 sm:max-w-52">
            </a>

            <nav class="hidden items-center gap-7 lg:flex" aria-label="Main navigation">
                <a href="{{ route('home').'#categories' }}" class="ck-nav-link ck-section-nav-link" data-section-link="categories">Collections</a>
                <a href="{{ route('home').'#featured' }}" class="ck-nav-link ck-section-nav-link" data-section-link="featured">New arrivals</a>
                <div class="relative flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('home').'#services' }}" class="ck-nav-link ck-section-nav-link" data-section-link="services">Our services</a>
                    <button type="button" @click="open = ! open" class="ml-1 rounded p-1 text-ck-dark transition hover:bg-ck-cream" :aria-expanded="open.toString()" aria-label="Show services menu"><span class="text-base leading-none" aria-hidden="true">⌄</span></button>
                    <div x-cloak x-show="open" x-transition class="absolute left-0 top-full z-50 mt-3 w-72 rounded-xl border border-black/10 bg-white py-2 shadow-xl">
                        @forelse($navigationServices as $navigationService)
                            <div class="group relative">
                                <a href="{{ route('services.show', $navigationService) }}" class="block px-4 py-3 text-sm font-medium normal-case tracking-normal text-ck-dark transition hover:bg-[#f3eee7]">{{ $navigationService->name }}</a>
                                @if($navigationService->short_description)
                                    <div class="pointer-events-none absolute left-full top-0 z-50 ml-3 w-64 rounded-xl bg-ck-dark px-4 py-3 text-xs normal-case leading-5 tracking-normal text-white opacity-0 shadow-xl transition-opacity duration-150 group-hover:opacity-100">
                                        {{ $navigationService->short_description }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <span class="block px-4 py-3 text-sm normal-case tracking-normal text-ck-dark/60">Services coming soon.</span>
                        @endforelse
                    </div>
                </div>
                <a href="{{ route('story') }}" @class(['ck-nav-link', 'rounded-md bg-ck-blue px-3 py-2 text-white shadow-sm hover:text-white' => request()->routeIs('story')]) @if(request()->routeIs('story')) aria-current="page" @endif>Our story</a>
                <a href="{{ route('contact') }}" @class(['ck-nav-link', 'rounded-md bg-ck-blue px-3 py-2 text-white shadow-sm hover:text-white' => request()->routeIs('contact')]) @if(request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
                <a href="{{ route('blog.index') }}" @class(['ck-nav-link', 'rounded-md bg-ck-blue px-3 py-2 text-white shadow-sm hover:text-white' => request()->routeIs('blog.*')]) @if(request()->routeIs('blog.*')) aria-current="page" @endif>Journal</a>
            </nav>

            <div class="flex items-center gap-3 text-[0.68rem] font-medium tracking-[0.14em] uppercase sm:gap-5">
                <a href="{{ route('shop.index') }}" @class(['hidden hover:text-ck-brown sm:inline', 'rounded-md bg-ck-blue px-3 py-2 text-white shadow-sm hover:text-white' => request()->routeIs('shop.*', 'products.show')]) @if(request()->routeIs('shop.*', 'products.show')) aria-current="page" @endif>Shop</a>
                <a href="{{ route('cart.index') }}" class="flex items-center gap-2 hover:text-ck-brown" aria-label="View your bag">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M5 8h14l-1 12H6L5 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg>
                    <span class="hidden sm:inline">Bag ({{ $cartItemCount }})</span>
                </a>
            </div>
        </div>

        <nav class="flex overflow-x-auto border-t border-black/6 px-4 py-3 lg:hidden" aria-label="Mobile navigation">
            <div class="mx-auto flex min-w-max gap-6 text-[0.65rem] font-medium tracking-[0.14em] uppercase">
                <a href="{{ route('shop.index') }}" @class(['rounded-md px-3 py-2', 'bg-ck-blue text-white shadow-sm' => request()->routeIs('shop.*', 'products.show')]) @if(request()->routeIs('shop.*', 'products.show')) aria-current="page" @endif>Shop</a>
                <a href="{{ route('home').'#categories' }}" class="ck-section-nav-link" data-section-link="categories">Collections</a>
                <a href="{{ route('home').'#featured' }}" class="ck-section-nav-link" data-section-link="featured">New arrivals</a>
                <div class="flex items-center gap-1"><a href="{{ route('home').'#services' }}" class="ck-section-nav-link" data-section-link="services">Our services</a><details class="relative"><summary class="cursor-pointer list-none rounded-md px-2 py-2" aria-label="Show services menu">⌄</summary><div class="absolute left-0 z-50 mt-3 w-72 overflow-hidden rounded-xl border border-black/10 bg-white py-2 shadow-xl">@forelse($navigationServices as $navigationService)<a href="{{ route('services.show', $navigationService) }}" class="block px-4 py-3 text-sm font-medium normal-case tracking-normal text-ck-dark transition hover:bg-[#f3eee7]">{{ $navigationService->name }}</a>@empty<span class="block px-4 py-3 text-sm normal-case tracking-normal text-ck-dark/60">Services coming soon.</span>@endforelse</div></details></div>
                <a href="{{ route('story') }}" @class(['rounded-md px-3 py-2', 'bg-ck-blue text-white shadow-sm' => request()->routeIs('story')]) @if(request()->routeIs('story')) aria-current="page" @endif>Our story</a>
                <a href="{{ route('contact') }}" @class(['rounded-md px-3 py-2', 'bg-ck-blue text-white shadow-sm' => request()->routeIs('contact')]) @if(request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
                <a href="{{ route('blog.index') }}" @class(['rounded-md px-3 py-2', 'bg-ck-blue text-white shadow-sm' => request()->routeIs('blog.*')]) @if(request()->routeIs('blog.*')) aria-current="page" @endif>Journal</a>
            </div>
        </nav>
    </header>

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    <footer id="contact" class="bg-ck-dark text-white">
        <div class="ck-container grid gap-12 py-16 md:grid-cols-[1.45fr_0.7fr_0.7fr_1fr] md:py-20">
            <div>
                <a href="{{ route('home') }}" class="inline-flex rounded-lg bg-white p-2"><img src="{{ asset('images/curtains-kenya-logo.png') }}" alt="Curtains Kenya" class="h-14 w-auto max-w-48 object-contain"></a>
                <p class="mt-5 max-w-xs text-sm leading-7 text-white/60">Practical window styling and soft furnishings chosen for life in Kenya.</p>
            </div>
            <div>
                <h2 class="ck-footer-heading"><a href="{{ route('shop.index') }}">Shop</a></h2>
                <ul class="ck-footer-list">
                    <li><a href="{{ route('shop.index') }}">Curtains &amp; blinds</a></li>
                    <li><a href="{{ route('shop.index') }}">Bednets &amp; bedding</a></li>
                    <li><a href="{{ route('shop.index') }}">Fabrics &amp; covers</a></li>
                    <li><a href="{{ route('blog.index') }}">Journal</a></li>
                </ul>
            </div>
            <div>
                <h2 class="ck-footer-heading">Service</h2>
                <ul class="ck-footer-list">
                    <li><a href="{{ route('story') }}">About Curtains Kenya</a></li>
                    <li><a href="{{ route('contact') }}">Delivery &amp; care</a></li>
                    <li><a href="{{ route('contact') }}">Talk to us</a></li>
                </ul>
            </div>
            <div>
                <h2 class="ck-footer-heading">A little inspiration</h2>
                <p class="mt-4 text-sm leading-7 text-white/60">Join for thoughtful styling notes and first access to seasonal collections.</p>
                <a href="{{ route('contact') }}" class="mt-5 inline-flex border-b border-white pb-1 text-[0.68rem] font-medium tracking-[0.14em] uppercase">Get in touch <span class="ml-4">↗</span></a>
            </div>
        </div>
        <div class="border-t border-white/15">
            <div class="ck-container flex flex-col gap-2 py-5 text-[0.65rem] tracking-[0.12em] text-white/45 uppercase sm:flex-row sm:justify-between">
                <span>© {{ date('Y') }} Curtains Kenya</span><span>Measured well. Finished beautifully.</span>
            </div>
        </div>
    </footer>

    @livewireScripts

    <script>
        const updateSectionNavigation = () => {
            const activeSection = window.location.hash.replace('#', '');

            document.querySelectorAll('[data-section-link]').forEach((link) => {
                const isActive = link.dataset.sectionLink === activeSection;
                link.classList.toggle('is-active', isActive);
                link.toggleAttribute('aria-current', isActive);
            });
        };

        document.addEventListener('DOMContentLoaded', updateSectionNavigation);
        window.addEventListener('hashchange', updateSectionNavigation);
    </script>

</body>
</html>
