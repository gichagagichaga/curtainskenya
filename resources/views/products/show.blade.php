@extends('layouts.public')

@section('title', $product->name . ' | Curtains Kenya')

@section('description', $product->short_description ?: $product->description)

@section('content')

{{-- Breadcrumb --}}
<section class="border-b border-[#e7dfd5] bg-white">
    <div class="mx-auto max-w-7xl px-6 py-5 lg:px-8">
        <nav class="flex items-center gap-2 text-sm text-[#8b7d70]" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="transition hover:text-[#8a6a4a]">
                Home
            </a>

            <span>/</span>

            <a href="{{ route('shop.index') }}" class="transition hover:text-[#8a6a4a]">
                Shop
            </a>

            <span>/</span>

            <a
                href="{{ route('shop.category', $product->category->slug) }}"
                class="transition hover:text-[#8a6a4a]"
            >
                {{ $product->category->name }}
            </a>

            <span>/</span>

            <span class="truncate text-[#4f453d]">
                {{ $product->name }}
            </span>
        </nav>
    </div>
</section>


{{-- Product --}}
<section class="bg-white">
    <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8 lg:py-20">

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-20">

            {{-- Product Image --}}
            <div>

                @if($product->images->count())

                    <div
                        x-data="{ selectedImage: @js(['src' => asset('storage/'.$product->images->first()->image_path), 'alt' => $product->images->first()->alt_text ?: $product->name]), zooming: false, zoomX: 50, zoomY: 50 }"
                    >
                        <div
                            @mouseenter="zooming = true"
                            @mouseleave="zooming = false"
                            @mousemove="const bounds = $el.getBoundingClientRect(); zoomX = (($event.clientX - bounds.left) / bounds.width) * 100; zoomY = (($event.clientY - bounds.top) / bounds.height) * 100"
                            class="group relative w-full cursor-zoom-in overflow-hidden bg-[#f3eee7]"
                        >
                            <img
                                :src="selectedImage.src"
                                :alt="selectedImage.alt"
                                :style="zooming ? `transform: scale(2.2); transform-origin: ${zoomX}% ${zoomY}%` : ''"
                                class="aspect-[4/5] h-full w-full object-cover transition-transform duration-150"
                            >
                            <span class="pointer-events-none absolute bottom-4 left-1/2 -translate-x-1/2 rounded-full bg-black/65 px-4 py-2 text-xs font-medium tracking-[0.14em] text-white uppercase opacity-0 transition" :class="zooming ? 'opacity-100' : 'opacity-0'">
                                Move to inspect fabric detail
                            </span>
                        </div>
                        <p class="mt-3 text-center text-xs font-medium tracking-[0.14em] text-[#8b7d70] uppercase">Hover to zoom and inspect fabric detail</p>

                        @if($product->images->count() > 1)
                            <div class="mt-4 grid grid-cols-4 gap-3">
                                @foreach($product->images as $image)
                                    <button
                                        type="button"
                                        @click="selectedImage = @js(['src' => asset('storage/'.$image->image_path), 'alt' => $image->alt_text ?: $product->name])"
                                        :class="selectedImage.src === '{{ asset('storage/'.$image->image_path) }}' ? 'ring-2 ring-[#8a6a4a] ring-offset-2' : 'ring-1 ring-black/8'"
                                        class="overflow-hidden bg-[#f3eee7] focus:outline-hidden focus:ring-2 focus:ring-[#8a6a4a] focus:ring-offset-2"
                                        aria-label="Show {{ $image->alt_text ?: $product->name }}"
                                    >
                                    <img
                                        src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $image->alt_text ?: $product->name }}"
                                            class="aspect-square h-full w-full object-cover transition duration-200 hover:scale-105"
                                    >
                                    </button>
                                @endforeach
                            </div>
                        @endif

                    </div>

                @else

                    <div class="flex aspect-[4/5] items-center justify-center bg-[#f3eee7]">
                        <div class="text-center">
                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full border border-[#d8cfc4] text-[#9b8d7f]">
                                <svg
                                    class="h-8 w-8"
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

                            <p class="mt-5 text-xs uppercase tracking-[0.25em] text-[#9b8d7f]">
                                Curtains Kenya
                            </p>

                            <p class="mt-2 text-sm text-[#8b7d70]">
                                Product image coming soon
                            </p>
                        </div>
                    </div>

                @endif

            </div>


            {{-- Product Information --}}
            <div class="flex flex-col justify-center">

                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#8a6a4a]">
                    {{ $product->category->name }}
                </p>

                <h1 class="mt-4 font-serif text-4xl tracking-tight text-[#29231e] sm:text-5xl">
                    {{ $product->name }}
                </h1>

                <div class="mt-6 flex items-center gap-4">

                    @if($product->sale_price)

                        <span class="text-2xl font-medium text-[#29231e]">
                            KSh {{ number_format($product->sale_price, 2) }}
                        </span>

                        <span class="text-lg text-[#a59a90] line-through">
                            KSh {{ number_format($product->price, 2) }}
                        </span>

                        <span class="bg-[#29231e] px-3 py-1 text-xs font-medium uppercase tracking-wider text-white">
                            Sale
                        </span>

                    @else

                        <span class="text-2xl font-medium text-[#29231e]">
                            KSh {{ number_format($product->price, 2) }}
                        </span>

                    @endif

                </div>


                @if($product->short_description)
                    <p class="mt-7 text-base leading-8 text-[#665b52]">
                        {{ $product->short_description }}
                    </p>
                @endif


                <div class="my-8 border-t border-[#e7dfd5]"></div>


                {{-- Stock --}}
                <div class="flex items-center gap-3 text-sm">

                    @if($product->stock_quantity > 0)

                        <span class="h-2.5 w-2.5 rounded-full bg-green-600"></span>

                        <span class="text-[#4f453d]">
                            In stock
                        </span>

                        <span class="text-[#998d82]">
                            ({{ $product->stock_quantity }} available)
                        </span>

                    @else

                        <span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>

                        <span class="text-[#4f453d]">
                            Currently out of stock
                        </span>

                    @endif

                </div>


                <div class="mt-8">
                    @if($product->stock_quantity > 0)
                        <form method="POST" action="{{ route('cart.store', $product) }}" class="flex gap-3">
                            @csrf
                            <label for="product-quantity" class="sr-only">Quantity</label>
                            <input id="product-quantity" name="quantity" type="number" min="1" max="{{ $product->stock_quantity }}" value="1" class="w-20 border border-[#d8cfc4] px-3 py-4 text-center text-sm">
                            <button class="flex flex-1 items-center justify-center bg-[#29231e] px-7 py-4 text-sm font-medium tracking-[0.15em] text-white uppercase transition hover:bg-[#463b33]">Add to bag</button>
                        </form>
                    @else
                        <a href="{{ route('contact') }}" class="flex w-full items-center justify-center bg-[#29231e] px-7 py-4 text-sm font-medium tracking-[0.15em] text-white uppercase transition hover:bg-[#463b33]">Enquire about this product</a>
                    @endif
                </div>


                {{-- Product Details --}}
                <div class="mt-10 border-t border-[#e7dfd5]">

                    <div class="border-b border-[#e7dfd5] py-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-[#8a6a4a]">
                            Product Details
                        </p>

                        @if($product->description)
                            <p class="mt-3 text-sm leading-7 text-[#665b52]">
                                {{ $product->description }}
                            </p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-6 py-5">

                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#998d82]">
                                Category
                            </p>

                            <p class="mt-1 text-sm text-[#4f453d]">
                                {{ $product->category->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wider text-[#998d82]">
                                SKU
                            </p>

                            <p class="mt-1 text-sm text-[#4f453d]">
                                {{ $product->sku }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>


{{-- Related Products --}}
@if($relatedProducts->count())

<section class="border-t border-[#e7dfd5] bg-[#faf8f5]">

    <div class="mx-auto max-w-7xl px-6 py-14 lg:px-8 lg:py-20">

        <div class="mb-10">
            <p class="text-xs font-semibold uppercase tracking-[0.25em] text-[#8a6a4a]">
                You May Also Like
            </p>

            <h2 class="mt-2 font-serif text-3xl text-[#29231e]">
                Related products
            </h2>
        </div>


        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4">

            @foreach($relatedProducts as $relatedProduct)

                <article class="group">

                    <a
                        href="{{ route('products.show', $relatedProduct->slug) }}"
                        class="relative block aspect-[4/5] overflow-hidden bg-[#f3eee7]"
                    >

                        @if($relatedProduct->images->first())

                            <img
                                src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}"
                                alt="{{ $relatedProduct->images->first()->alt_text ?: $relatedProduct->name }}"
                                class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                            >

                        @else

                            <div class="flex h-full items-center justify-center">
                                <span class="text-xs uppercase tracking-widest text-[#9b8d7f]">
                                    Curtains Kenya
                                </span>
                            </div>

                        @endif

                    </a>

                    <div class="mt-4">

                        <p class="text-xs uppercase tracking-[0.18em] text-[#9a8877]">
                            {{ $relatedProduct->category->name }}
                        </p>

                        <h3 class="mt-2 font-serif text-lg text-[#29231e]">
                            <a
                                href="{{ route('products.show', $relatedProduct->slug) }}"
                                class="transition hover:text-[#8a6a4a]"
                            >
                                {{ $relatedProduct->name }}
                            </a>
                        </h3>

                        <div class="mt-2">

                            @if($relatedProduct->sale_price)

                                <span class="font-medium text-[#29231e]">
                                    KSh {{ number_format($relatedProduct->sale_price, 2) }}
                                </span>

                                <span class="ml-2 text-sm text-[#a59a90] line-through">
                                    KSh {{ number_format($relatedProduct->price, 2) }}
                                </span>

                            @else

                                <span class="font-medium text-[#29231e]">
                                    KSh {{ number_format($relatedProduct->price, 2) }}
                                </span>

                            @endif

                        </div>

                    </div>

                </article>

            @endforeach

        </div>

    </div>

</section>

@endif


{{-- Final CTA --}}
<section class="bg-[#29231e] text-white">

    <div class="mx-auto max-w-7xl px-6 py-14 text-center lg:px-8 lg:py-16">

        <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#cbb49b]">
            Need help choosing?
        </p>

        <h2 class="mx-auto mt-4 max-w-2xl font-serif text-3xl sm:text-4xl">
            Let us help you find the perfect textile for your space.
        </h2>

        <p class="mx-auto mt-5 max-w-xl text-sm leading-7 text-[#d7cec5]">
            Contact Curtains Kenya for product information, custom requirements
            and professional advice.
        </p>

        <a
            href="{{ route('shop.index') }}"
            class="mt-8 inline-flex items-center border border-white px-7 py-3 text-sm font-medium uppercase tracking-wider transition hover:bg-white hover:text-[#29231e]"
        >
            Continue Shopping
        </a>

    </div>

</section>

@endsection
