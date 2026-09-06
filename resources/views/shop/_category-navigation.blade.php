@php($activeCategory = $activeCategory ?? null)

<section class="border-b border-[#e7dfd5] bg-white">
    <nav aria-label="Shop categories" class="mx-auto max-w-7xl px-6 py-6 lg:px-8">
        <div class="flex flex-wrap gap-3">
            <a
                href="{{ route('shop.index') }}"
                class="whitespace-nowrap rounded-full border px-5 py-2.5 text-sm font-medium transition {{ $activeCategory ? 'border-[#ded5ca] bg-white text-[#4f453d] hover:border-[#8a6a4a] hover:text-[#8a6a4a]' : 'border-[#29231e] bg-[#29231e] text-white hover:bg-[#463b33]' }}"
            >
                All Products
            </a>

            @foreach ($categories as $menuCategory)
                @php($isActiveCategory = $activeCategory && ($activeCategory->id === $menuCategory->id || $activeCategory->parent_id === $menuCategory->id))

                <details class="group relative" data-category-menu="{{ $menuCategory->slug }}">
                    <summary class="flex cursor-pointer list-none items-center gap-2 whitespace-nowrap rounded-full border px-5 py-2.5 text-sm transition marker:hidden [&::-webkit-details-marker]:hidden {{ $isActiveCategory ? 'border-[#29231e] bg-[#29231e] text-white' : 'border-[#ded5ca] bg-white text-[#4f453d] hover:border-[#8a6a4a] hover:text-[#8a6a4a]' }}">
                        <span>{{ $menuCategory->name }}</span>
                        <svg aria-hidden="true" class="h-3.5 w-3.5 transition group-open:rotate-180" fill="none" viewBox="0 0 20 20" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m5 7.5 5 5 5-5" />
                        </svg>
                    </summary>

                    <div class="absolute left-0 z-30 mt-2 min-w-64 overflow-hidden rounded-xl border border-[#e7dfd5] bg-white p-2 shadow-xl">
                        <a href="{{ route('shop.category', $menuCategory) }}" class="block rounded-lg px-4 py-3 text-sm font-semibold text-[#29231e] transition hover:bg-[#f3eee7]">
                            View all {{ $menuCategory->name }}
                        </a>

                        @foreach ($menuCategory->children as $menuSubcategory)
                            <a href="{{ route('shop.category', $menuSubcategory) }}" class="block rounded-lg px-4 py-3 text-sm text-[#665b52] transition hover:bg-[#f3eee7] hover:text-[#29231e]">
                                {{ $menuSubcategory->name }}
                            </a>
                        @endforeach

                        @if ($menuCategory->children->isEmpty())
                            <p class="px-4 py-3 text-sm text-[#998d82]">No subcategories yet</p>
                        @endif
                    </div>
                </details>
            @endforeach
        </div>
    </nav>
</section>
