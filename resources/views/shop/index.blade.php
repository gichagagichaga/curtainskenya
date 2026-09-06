@extends('layouts.public')

@section('title', 'Shop | Curtains Kenya')

@section('description', 'Explore curtains, blinds, bedding, bednets, seat covers, fabrics and home textiles from Curtains Kenya.')

@section('content')

<style>
    .shop-product-image { aspect-ratio: 1 / 1; }
    .shop-product-card {
        border: 1px solid #d8cfc4;
        background: #fff;
        padding: 0.375rem;
    }
    .shop-product-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .shop-product-title { font-size: 0.78rem; line-height: 1.25; }
    .shop-product-price { font-size: 0.68rem; line-height: 1.25; }
    .shop-catalogue-layout {
        display: grid;
        grid-template-columns: 7rem minmax(0, 1fr);
        align-items: start;
        gap: 0.75rem;
    }
    .shop-category-sidebar {
        position: sticky;
        top: 11rem;
        display: block;
        max-height: calc(100svh - 12rem);
        overflow-y: auto;
        padding: 0.75rem;
    }
    .shop-price-fields { display: grid; gap: 0.5rem; }

    @media (min-width: 640px) {
        .shop-catalogue-layout { grid-template-columns: 12rem minmax(0, 1fr); gap: 1.5rem; }
        .shop-category-sidebar { padding: 1rem; }
        .shop-price-fields { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .shop-product-image { aspect-ratio: 4 / 5; }
        .shop-product-card { padding: 0.75rem; }
        .shop-product-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .shop-product-title { font-size: 1.125rem; line-height: 1.75rem; }
        .shop-product-price { font-size: 1rem; line-height: 1.5rem; }
    }

    @media (min-width: 1024px) {
        .shop-catalogue-layout { grid-template-columns: 15rem minmax(0, 1fr); align-items: start; }
        .shop-category-sidebar { top: 6rem; max-height: calc(100vh - 7rem); padding: 1.25rem; }
        .shop-product-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    }

    @media (min-width: 1280px) {
        .shop-product-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    }
</style>

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


{{-- Products --}}
<section class="bg-[#f5f3f0]">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">

        <div class="shop-catalogue-layout">
            <aside class="shop-category-sidebar border border-[#d8cfc4] bg-white p-5" aria-label="Shop categories">
                <p class="text-xs font-semibold tracking-[0.18em] text-[#29231e] uppercase">Category</p>
                <a href="{{ route('shop.index', request()->except('category', 'subcategory', 'page')) }}" class="mt-4 block text-sm font-medium {{ empty($filters['category']) ? 'text-[#8a6a4a]' : 'text-[#29231e]' }}">All products</a>
                <div class="mt-4 space-y-4">
                    @foreach($categories as $parentCategory)
                        <div>
                            <a href="{{ route('shop.index', array_merge(request()->except('category', 'subcategory', 'page'), ['category' => $parentCategory->id])) }}" class="block text-sm font-semibold {{ (string) ($filters['category'] ?? '') === (string) $parentCategory->id ? 'text-[#8a6a4a]' : 'text-[#29231e]' }}">{{ $parentCategory->name }}</a>
                            @if($parentCategory->children->isNotEmpty())
                                <div class="mt-2 space-y-1.5 border-l border-[#e4ddd5] pl-3">
                                    @foreach($parentCategory->children as $subcategory)
                                        <a href="{{ route('shop.index', array_merge(request()->except('category', 'subcategory', 'page'), ['category' => $parentCategory->id, 'subcategory' => $subcategory->id])) }}" class="block text-xs leading-5 {{ (string) ($filters['subcategory'] ?? '') === (string) $subcategory->id ? 'font-semibold text-[#8a6a4a]' : 'text-[#665b52] hover:text-[#29231e]' }}">{{ $subcategory->name }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <form method="GET" action="{{ route('shop.index') }}" data-shop-filters class="mt-6 border-t border-[#d8cfc4] pt-5">
                    <p class="text-xs font-semibold tracking-[0.18em] text-[#29231e] uppercase">Filter products</p>
                    <div class="mt-4 space-y-3">
                        <div>
                            <label for="shop-q" class="text-[0.65rem] font-semibold tracking-[0.14em] text-[#665b52] uppercase">Search</label>
                            <input id="shop-q" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Search products" class="mt-1.5 block w-full border border-[#d8cfc4] bg-white px-3 py-2.5 text-sm">
                        </div>
                        <div>
                            <label for="shop-category" class="text-[0.65rem] font-semibold tracking-[0.14em] text-[#665b52] uppercase">Category</label>
                            <select id="shop-category" name="category" class="mt-1.5 block w-full border border-[#d8cfc4] bg-white px-3 py-2.5 text-sm">
                                <option value="">All categories</option>
                                @foreach($categories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" @selected((string) ($filters['category'] ?? '') === (string) $parentCategory->id)>{{ $parentCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="shop-subcategory" class="text-[0.65rem] font-semibold tracking-[0.14em] text-[#665b52] uppercase">Subcategory</label>
                            <select id="shop-subcategory" name="subcategory" class="mt-1.5 block w-full border border-[#d8cfc4] bg-white px-3 py-2.5 text-sm">
                                <option value="">All subcategories</option>
                                @foreach($categories as $parentCategory)
                                    @foreach($parentCategory->children as $subcategory)
                                        <option value="{{ $subcategory->id }}" data-parent-id="{{ $parentCategory->id }}" @selected((string) ($filters['subcategory'] ?? '') === (string) $subcategory->id)>{{ $subcategory->name }}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="shop-price-fields">
                            <div><label for="min-price" class="text-[0.65rem] font-semibold tracking-[0.14em] text-[#665b52] uppercase">Min price</label><input id="min-price" name="min_price" type="number" min="0" step="100" value="{{ $filters['min_price'] ?? '' }}" placeholder="0" class="mt-1.5 block w-full border border-[#d8cfc4] bg-white px-2 py-2.5 text-sm"></div>
                            <div><label for="max-price" class="text-[0.65rem] font-semibold tracking-[0.14em] text-[#665b52] uppercase">Max price</label><input id="max-price" name="max_price" type="number" min="0" step="100" value="{{ $filters['max_price'] ?? '' }}" placeholder="Any" class="mt-1.5 block w-full border border-[#d8cfc4] bg-white px-2 py-2.5 text-sm"></div>
                        </div>
                    </div>
                    <button class="mt-4 w-full bg-[#29231e] px-4 py-2.5 text-xs font-semibold tracking-[0.14em] text-white uppercase">Apply filters</button>
                    @if(collect($filters)->filter(fn ($value) => $value !== null && $value !== '')->isNotEmpty())<a href="{{ route('shop.index') }}" class="mt-3 block text-center text-xs font-semibold text-[#8a6a4a] underline underline-offset-4">Clear filters</a>@endif
                    @error('max_price')<p class="mt-2 text-sm text-red-700">{{ $message }}</p>@enderror
                </form>
            </aside>

            <div class="min-w-0">
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

            <div data-shop-product-grid class="shop-product-grid grid grid-cols-2 gap-x-2 gap-y-5 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-12 lg:grid-cols-3 xl:grid-cols-4">

                @foreach($products as $product)

                    <article data-shop-product-card class="shop-product-card group">

                        {{-- Product Image --}}
                        <a
                            href="{{ route('products.show', $product->slug) }}"
                            class="shop-product-image relative block overflow-hidden bg-[#f3eee7]"
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
                                <span class="absolute left-1 top-1 bg-[#29231e] px-1.5 py-1 text-[0.5rem] font-medium uppercase tracking-wider text-white sm:left-4 sm:top-4 sm:px-3 sm:py-1.5 sm:text-xs">
                                    Sale
                                </span>
                            @endif

                        </a>


                        {{-- Product Information --}}
                        <div class="mt-2 sm:mt-5">

                            <p class="hidden text-xs uppercase tracking-[0.18em] text-[#9a8877] sm:block">
                                {{ $product->category->name }}
                            </p>

                            <h3 class="shop-product-title font-serif text-[#29231e] sm:mt-2">
                                <a
                                    href="{{ route('products.show', $product->slug) }}"
                                    class="transition hover:text-[#8a6a4a]"
                                >
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <p class="mt-2 hidden line-clamp-2 text-sm leading-6 text-[#766b61] sm:block">
                                {{ $product->short_description }}
                            </p>


                            {{-- Price --}}
                            <div class="shop-product-price mt-1.5 flex flex-col gap-0.5 sm:mt-4 sm:flex-row sm:items-center sm:gap-3">

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
                                <form method="POST" action="{{ route('cart.store', $product) }}" class="mt-5 hidden sm:block">
                                    @csrf
                                    <button class="w-full border border-[#29231e] px-4 py-2.5 text-xs font-medium tracking-[0.14em] text-[#29231e] uppercase transition hover:bg-[#29231e] hover:text-white">Add to bag</button>
                                </form>
                            @else
                                <p class="mt-2 text-[0.55rem] font-medium tracking-[0.08em] text-[#9b8d7f] uppercase sm:mt-5 sm:text-xs sm:tracking-[0.14em]">Out of stock</p>
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
        </div>

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const category = document.getElementById('shop-category');
        const subcategory = document.getElementById('shop-subcategory');

        if (! category || ! subcategory) return;

        const options = Array.from(subcategory.options).slice(1);
        const filterSubcategories = () => {
            options.forEach((option) => {
                const visible = category.value === '' || option.dataset.parentId === category.value;
                option.hidden = ! visible;
                option.disabled = ! visible;
            });

            if (subcategory.selectedOptions[0]?.disabled) subcategory.value = '';
        };

        category.addEventListener('change', filterSubcategories);
        filterSubcategories();
    });
</script>


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
