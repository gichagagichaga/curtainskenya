<x-layouts::app :title="__('Edit product')">
    <div class="mx-auto w-full max-w-5xl p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-4 border-b border-zinc-200 pb-6 dark:border-zinc-700 sm:flex-row sm:items-start sm:justify-between"><div><a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">← Back to products</a><h1 class="mt-3 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Edit {{ $product->name }}</h1><p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Changes are reflected on the public shop when the product is active.</p></div><form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product and all of its images?');">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center justify-center rounded-lg border border-red-200 px-4 py-2.5 text-sm font-medium text-red-700 transition hover:bg-red-50 dark:border-red-900 dark:text-red-300 dark:hover:bg-red-950/40">Delete product</button></form></div>
        @if (session('status'))<div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950/40 dark:text-emerald-300">{{ session('status') }}</div>@endif
        @if ($product->images->isNotEmpty())
            <section x-data="{ preview: null }" @keydown.escape.window="preview = null" class="mt-6 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 sm:p-6">
                <div class="flex items-baseline justify-between gap-4"><h2 class="text-base font-semibold text-zinc-900 dark:text-white">Current images</h2><p class="text-xs text-zinc-500 dark:text-zinc-400">Click an image to enlarge</p></div>
                <div class="mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                    @foreach ($product->images as $image)
                        <div class="overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
                            <button type="button" @click="preview = { src: '{{ asset('storage/'.$image->image_path) }}', alt: @js($image->alt_text ?: $product->name) }" class="group relative block w-full overflow-hidden text-left focus:outline-hidden focus:ring-2 focus:ring-zinc-900 focus:ring-offset-2 dark:focus:ring-white dark:focus:ring-offset-zinc-900" aria-label="Enlarge {{ $image->alt_text ?: $product->name }}">
                                <img src="{{ asset('storage/'.$image->image_path) }}" alt="{{ $image->alt_text ?: $product->name }}" class="aspect-square w-full object-cover transition duration-200 group-hover:scale-105">
                                <span class="absolute inset-0 grid place-items-center bg-black/0 text-sm font-medium text-white opacity-0 transition group-hover:bg-black/40 group-hover:opacity-100">View full size</span>
                            </button>
                            <form method="POST" action="{{ route('admin.products.images.destroy', [$product, $image]) }}" class="p-2">@csrf @method('DELETE')<button type="submit" class="w-full rounded-md px-2 py-1.5 text-xs font-medium text-red-700 hover:bg-red-50 dark:text-red-300 dark:hover:bg-red-950/40">Remove image</button></form>
                        </div>
                    @endforeach
                </div>
                <div x-cloak x-show="preview" x-transition.opacity class="fixed inset-0 z-50 grid place-items-center bg-black/80 p-4" @click.self="preview = null" role="dialog" aria-modal="true" aria-label="Product image preview">
                    <div class="relative max-h-full max-w-5xl"><img :src="preview?.src" :alt="preview?.alt" class="max-h-[85vh] max-w-full rounded-lg object-contain shadow-2xl"><button type="button" @click="preview = null" class="absolute -right-2 -top-2 flex size-9 items-center justify-center rounded-full bg-white text-lg font-medium text-zinc-900 shadow-lg hover:bg-zinc-100" aria-label="Close image preview">×</button></div>
                </div>
            </section>
        @endif
        @include('admin.products._form', ['product' => $product])
    </div>
</x-layouts::app>
