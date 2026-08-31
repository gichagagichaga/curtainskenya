@extends('layouts.public')

@section('title', 'Shop | Curtains Kenya')

@section('description', 'Explore curtains, blinds, bedding, bednets, seat covers, fabrics and home textiles from Curtains Kenya.')

@section('content')

{{-- Page Header --}}
<section class="bg-[#f3eee7]">
    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-20">
        <div class="max-w-3xl">
            <a href="{{ route('home') }}" class="inline-flex items-center text-xs font-semibold tracking-[0.18em] text-[#8a6a4a] uppercase transition hover:text-[#29231e]">← Home</a>
            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#8a6a4a]">
                Curtains Kenya Collection
            </p>

            <h1 class="mt-4 font-serif text-4xl tracking-tight text-[#29231e] sm:text-5xl lg:text-6xl">
                Beautiful textiles for beautiful spaces.
            </h1>

            <p class="mt-6 max-w-2xl text-base leading-7 text-[#665b52]">
                Discover our collection of curtains, blinds, bedding, bednets,
                seat covers, fabrics and other carefully selected home textiles.
            </p>
        </div>
    </div>
</section>


{{-- Category Navigation --}}
<section class="border-b border-[#e7dfd5] bg-white">
    <div class="mx-auto max-w-7xl px-6 py-6 lg:px-8">

        <div class="flex gap-3 overflow-x-auto pb-2">
            <a
                href="{{ route('shop.index') }}"
                class="whitespace-nowrap rounded-full border border-[#29231e] bg-[#29231e] px-5 py-2.5 text-sm font-medium text-white transition hover:bg-[#463b33]"
            >
                All Products
            </a>

            @foreach($categories as $category)
                <a
                    href="{{ route('shop.category', $category->slug) }}"
                    class="whitespace-nowrap rounded-full border border-[#ded5ca] bg-white px-5 py-2.5 text-sm text-[#4f453d] transition hover:border-[#8a6a4a] hover:text-[#8a6a4a]"
                >
                    {{ $category->name }}

                    <span class="ml-1 text-xs text-[#998d82]">
                        {{ $category->products_count }}
                    </span>
                </a>
            @endforeach
        </div>

    </div>
</section>


{{-- Products --}}
<section class="bg-white">
    <div class="mx-auto max-w-7xl px-6 py-14 lg:px-8 lg:py-20">

        <div class="mb-10 flex items-end justify-between gap-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#8a6a4a]">
                    Our Products
                </p>

                <h2 class="mt-2 font-serif text-3xl text-[#29231e]">
                    Shop the collection
                </h2>
            </div>

            <p class="hidden text-sm text-[#81766c] sm:block">
                {{ $products->total() }} products
            </p>
        </div>


        @if($products->count())

            <div class="grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                @foreach($products as $product)

                    <article class="group">

                        {{-- Product Image --}}
                        <a
                            href="{{ route('products.show', $product->slug) }}"
                            class="relative block aspect-[4/5] overflow-hidden bg-[#f3eee7]"
                        >

                            @if($product->images->first())

                                <img
                                    src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                                    alt="{{ $product->images->first()->alt_text ?: $product->name }}"
                                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                                >

                            @else

                                <div class="flex h-full items-center justify-center">
                                    <div class="text-center">
                                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full border border-[#d8cfc4] text-[#9b8d7f]">
                                            <svg
                                                class="h-6 w-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                />
                                            </svg>
                                        </div>

                                        <span class="text-xs uppercase tracking-widest text-[#9b8d7f]">
                                            Curtains Kenya
                                        </span>
                                    </div>
                                </div>

                            @endif


                            {{-- Sale Badge --}}
                            @if($product->sale_price)
                                <span class="absolute left-4 top-4 bg-[#29231e] px-3 py-1.5 text-xs font-medium uppercase tracking-wider text-white">
                                    Sale
                                </span>
                            @endif

                        </a>


                        {{-- Product Information --}}
                        <div class="mt-5">

                            <p class="text-xs uppercase tracking-[0.18em] text-[#9a8877]">
                                {{ $product->category->name }}
                            </p>

                            <h3 class="mt-2 font-serif text-lg text-[#29231e]">
                                <a
                                    href="{{ route('products.show', $product->slug) }}"
                                    class="transition hover:text-[#8a6a4a]"
                                >
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <p class="mt-2 line-clamp-2 text-sm leading-6 text-[#766b61]">
                                {{ $product->short_description }}
                            </p>


                            {{-- Price --}}
                            <div class="mt-4 flex items-center gap-3">

                                @if($product->sale_price)

                                    <span class="font-medium text-[#29231e]">
                                        KSh {{ number_format($product->sale_price, 2) }}
                                    </span>

                                    <span class="text-sm text-[#a59a90] line-through">
                                        KSh {{ number_format($product->price, 2) }}
                                    </span>

                                @else

                                    <span class="font-medium text-[#29231e]">
                                        KSh {{ number_format($product->price, 2) }}
                                    </span>

                                @endif

                            </div>

                            @if($product->stock_quantity > 0)
                                <form method="POST" action="{{ route('cart.store', $product) }}" class="mt-5">
                                    @csrf
                                    <button class="w-full border border-[#29231e] px-4 py-2.5 text-xs font-medium tracking-[0.14em] text-[#29231e] uppercase transition hover:bg-[#29231e] hover:text-white">Add to bag</button>
                                </form>
                            @else
                                <p class="mt-5 text-xs font-medium tracking-[0.14em] text-[#9b8d7f] uppercase">Out of stock</p>
                            @endif

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="mt-16">
                    {{ $products->links() }}
                </div>
            @endif

        @else

            <div class="py-20 text-center">
                <h3 class="font-serif text-2xl text-[#29231e]">
                    No products available yet.
                </h3>

                <p class="mt-3 text-[#766b61]">
                    Please check back soon for our latest collection.
                </p>
            </div>

        @endif

    </div>
</section>


{{-- Consultation CTA --}}
<section class="bg-[#29231e] text-white">
    <div class="mx-auto max-w-7xl px-6 py-16 text-center lg:px-8 lg:py-20">

        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#cbb49b]">
            Need something special?
        </p>

        <h2 class="mx-auto mt-4 max-w-2xl font-serif text-3xl sm:text-4xl">
            Let us help you create the perfect space.
        </h2>

        <p class="mx-auto mt-5 max-w-xl text-sm leading-7 text-[#d7cec5]">
            Looking for custom curtains, blinds, bedding or upholstery fabrics?
            Talk to our team about your requirements.
        </p>

        <a
            href="#"
            class="mt-8 inline-flex items-center border border-white px-7 py-3 text-sm font-medium uppercase tracking-wider transition hover:bg-white hover:text-[#29231e]"
        >
            Request a Quote
        </a>

    </div>
</section>

@endsection
