<x-layouts::app :title="__('Products')">
    <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-4 border-b border-zinc-200 pb-6 dark:border-zinc-700 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Curtains Kenya catalogue</p>
                <h1 class="mt-1 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Products</h1>
            </div>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">Add product</a>
        </div>

        @if (session('status'))
            <div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950/40 dark:text-emerald-300">{{ session('status') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.products.index') }}" class="mt-6 grid gap-3 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 sm:grid-cols-2 lg:grid-cols-5">
            <label class="sr-only" for="product-search">Search products</label>
            <input id="product-search" name="search" value="{{ request('search') }}" placeholder="Search name or SKU" class="rounded-lg border-zinc-300 px-3 py-2 text-sm dark:border-zinc-600 dark:bg-zinc-800 dark:text-white">
            <select name="category" class="rounded-lg border-zinc-300 px-3 py-2 text-sm dark:border-zinc-600 dark:bg-zinc-800 dark:text-white"><option value="">All categories</option>@foreach($filterCategories as $category)<option value="{{ $category->id }}" @selected((string) request('category') === (string) $category->id)>{{ $category->name }}</option>@endforeach</select>
            <select name="visibility" class="rounded-lg border-zinc-300 px-3 py-2 text-sm dark:border-zinc-600 dark:bg-zinc-800 dark:text-white"><option value="">All visibility</option><option value="active" @selected(request('visibility') === 'active')>Active</option><option value="hidden" @selected(request('visibility') === 'hidden')>Hidden</option></select>
            <select name="stock" class="rounded-lg border-zinc-300 px-3 py-2 text-sm dark:border-zinc-600 dark:bg-zinc-800 dark:text-white"><option value="">All stock</option><option value="in_stock" @selected(request('stock') === 'in_stock')>In stock (11+)</option><option value="low_stock" @selected(request('stock') === 'low_stock')>Low stock (1–10)</option><option value="out_of_stock" @selected(request('stock') === 'out_of_stock')>Out of stock</option></select>
            <select name="sort" class="rounded-lg border-zinc-300 px-3 py-2 text-sm dark:border-zinc-600 dark:bg-zinc-800 dark:text-white"><option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest first</option><option value="oldest" @selected(request('sort') === 'oldest')>Oldest first</option><option value="name_asc" @selected(request('sort') === 'name_asc')>Name: A–Z</option><option value="name_desc" @selected(request('sort') === 'name_desc')>Name: Z–A</option><option value="price_low" @selected(request('sort') === 'price_low')>Price: low to high</option><option value="price_high" @selected(request('sort') === 'price_high')>Price: high to low</option><option value="stock_low" @selected(request('sort') === 'stock_low')>Stock: low to high</option><option value="stock_high" @selected(request('sort') === 'stock_high')>Stock: high to low</option></select>
            <div class="flex gap-3 sm:col-span-2 lg:col-span-5"><button class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-700 dark:bg-white dark:text-zinc-900">Apply</button><a href="{{ route('admin.products.index') }}" class="rounded-lg border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Clear filters</a></div>
        </form>

        <div class="mt-6 overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            @if ($products->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 text-left text-sm dark:divide-zinc-700">
                        <thead class="bg-zinc-50 text-xs font-medium tracking-wide text-zinc-500 uppercase dark:bg-zinc-800/60 dark:text-zinc-400">
                            <tr><th class="px-4 py-3 sm:px-6">Product</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">Price</th><th class="px-4 py-3">Stock</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right sm:px-6">Actions</th></tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            @foreach ($products as $product)
                                <tr class="text-zinc-700 dark:text-zinc-200">
                                    <td class="px-4 py-4 sm:px-6"><div class="flex items-center gap-3">
                                        @if ($product->images->first())
                                            <img src="{{ asset('storage/'.$product->images->first()->image_path) }}" alt="" class="size-12 rounded-md object-cover">
                                        @else
                                            <div class="flex size-12 items-center justify-center rounded-md bg-zinc-100 text-xs text-zinc-400 dark:bg-zinc-800">No image</div>
                                        @endif
                                        <div><p class="font-medium text-zinc-900 dark:text-white">{{ $product->name }}</p><p class="mt-0.5 text-xs text-zinc-500">{{ $product->sku ?: 'No SKU' }}</p></div>
                                    </div></td>
                                    <td class="px-4 py-4">{{ $product->category->name }}</td>
                                    <td class="px-4 py-4">KSh {{ number_format($product->sale_price ?: $product->price, 2) }}</td>
                                    <td class="px-4 py-4">
                                        <div class="min-w-40">
                                            <p class="mb-2 text-xs font-medium {{ $product->stock_quantity === 0 ? 'text-red-600 dark:text-red-400' : ($product->stock_quantity <= 10 ? 'text-yellow-600 dark:text-yellow-400' : 'text-emerald-600 dark:text-emerald-400') }}">
                                                {{ $product->stock_quantity === 0 ? 'Out of stock' : ($product->stock_quantity <= 10 ? 'Low stock' : 'In stock') }} · {{ $product->stock_quantity }} {{ $product->stock_quantity === 1 ? 'item' : 'items' }}
                                            </p>
                                            <form method="POST" action="{{ route('admin.products.stock.update', $product) }}" class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <label for="stock-{{ $product->id }}" class="sr-only">Stock quantity for {{ $product->name }}</label>
                                                <input id="stock-{{ $product->id }}" name="stock_quantity" type="number" min="0" max="1000000" value="{{ $product->stock_quantity }}" class="w-20 rounded-md border-zinc-300 px-2 py-1.5 text-sm dark:border-zinc-600 dark:bg-zinc-800 dark:text-white">
                                                <button class="rounded-md border border-zinc-300 px-2.5 py-1.5 text-xs font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Update</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $product->is_active ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300' }}">{{ $product->is_active ? 'Active' : 'Hidden' }}</span></td>
                                    <td class="px-4 py-4 text-right sm:px-6"><a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-medium text-zinc-900 hover:underline dark:text-white">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($products->hasPages())
                    <div class="border-t border-zinc-200 px-4 py-4 dark:border-zinc-700 sm:px-6">{{ $products->links() }}</div>
                @endif
            @else
                <div class="px-6 py-16 text-center"><h2 class="text-lg font-semibold text-zinc-900 dark:text-white">No products yet</h2><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Add the first item to your Curtains Kenya catalogue.</p><a href="{{ route('admin.products.create') }}" class="mt-5 inline-flex text-sm font-medium text-zinc-900 hover:underline dark:text-white">Add a product</a></div>
            @endif
        </div>
    </div>
</x-layouts::app>
