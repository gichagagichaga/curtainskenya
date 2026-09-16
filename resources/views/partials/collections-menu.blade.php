<div class="relative" x-data="{ open: false }" @close-navigation.window="open = false" @keydown.escape.window="open = false" @click.outside="open = false">
    <div class="flex items-center">
        <a href="{{ route('home').'#categories' }}" class="{{ $mobile ? 'rounded-lg px-3 py-3' : 'ck-nav-link ck-section-nav-link' }}" data-section-link="categories">Collections</a>
        <button type="button" @click="open = !open" :aria-expanded="open.toString()" aria-label="Show collections menu" class="rounded p-2">⌄</button>
    </div>
    <div x-cloak x-show="open" class="{{ $mobile ? 'pl-3' : 'absolute left-0 top-full w-72 shadow-xl' }} z-50 max-h-80 overflow-y-auto rounded-lg border border-black/10 bg-white py-2">
        @foreach($navigationCategories as $navigationCategory)
            <a href="{{ route('shop.category', $navigationCategory) }}" class="block px-4 py-2 text-sm font-medium hover:bg-ck-cream">{{ $navigationCategory->name }}</a>
            @foreach($navigationCategory->children as $navigationSubcategory)
                <a href="{{ route('shop.category', $navigationSubcategory) }}" class="block py-2 pl-7 pr-4 text-sm hover:bg-ck-cream">{{ $navigationSubcategory->name }}</a>
            @endforeach
        @endforeach
    </div>
</div>
