<form method="POST" action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    @if ($product) @method('PUT') @endif
    <div class="grid gap-6 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 sm:p-6 lg:grid-cols-2">
        <div class="lg:col-span-2"><label for="name" class="text-sm font-medium text-zinc-900 dark:text-white">Product name</label><input id="name" name="name" type="text" value="{{ old('name', $product?->name) }}" required class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-white dark:focus:ring-white">@error('name')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror</div>
        @php
            $selectedCategoryId = (string) old('category_id', $product?->category_id);
            $selectedParent = collect($categories)->first(
                fn ($category) => (string) $category->id === $selectedCategoryId
                    || $category->children->contains(fn ($subcategory) => (string) $subcategory->id === $selectedCategoryId)
            );
            $selectedParentId = (string) old('parent_category_id', $selectedParent?->id);
        @endphp
        <div>
            <label for="parent_category_id" class="text-sm font-medium text-zinc-900 dark:text-white">Product category</label>
            <select id="parent_category_id" name="parent_category_id" required class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-white dark:focus:ring-white">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($selectedParentId === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('parent_category_id')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="category_id" class="text-sm font-medium text-zinc-900 dark:text-white">Product subcategory</label>
            <select id="category_id" name="category_id" required disabled class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm disabled:cursor-not-allowed disabled:bg-zinc-100 disabled:text-zinc-400 focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:disabled:bg-zinc-800 dark:disabled:text-zinc-500 dark:focus:border-white dark:focus:ring-white">
                <option value="">Choose a product category first</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" data-parent-id="{{ $category->id }}" @selected($selectedCategoryId === (string) $category->id)>No subcategory — use {{ $category->name }}</option>
                    @foreach ($category->children as $subcategory)
                        <option value="{{ $subcategory->id }}" data-parent-id="{{ $category->id }}" @selected($selectedCategoryId === (string) $subcategory->id)>{{ $subcategory->name }}</option>
                    @endforeach
                @endforeach
            </select>
            <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">Only subcategories belonging to the selected category are shown.</p>
            @error('category_id')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror
        </div>
        <div><label for="sku" class="text-sm font-medium text-zinc-900 dark:text-white">SKU <span class="font-normal text-zinc-500">(optional)</span></label><input id="sku" name="sku" type="text" value="{{ old('sku', $product?->sku) }}" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-white dark:focus:ring-white">@error('sku')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror</div>
        <div><label for="price" class="text-sm font-medium text-zinc-900 dark:text-white">Price (KSh)</label><input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $product?->price) }}" required class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-white dark:focus:ring-white">@error('price')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror</div>
        <div><label for="sale_price" class="text-sm font-medium text-zinc-900 dark:text-white">Sale price (KSh) <span class="font-normal text-zinc-500">(optional)</span></label><input id="sale_price" name="sale_price" type="number" min="0" step="0.01" value="{{ old('sale_price', $product?->sale_price) }}" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-white dark:focus:ring-white">@error('sale_price')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror</div>
        <div><label for="stock_quantity" class="text-sm font-medium text-zinc-900 dark:text-white">Stock quantity</label><input id="stock_quantity" name="stock_quantity" type="number" min="0" step="1" value="{{ old('stock_quantity', $product?->stock_quantity ?? 0) }}" required class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-white dark:focus:ring-white">@error('stock_quantity')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror</div>
        <div class="lg:col-span-2"><label for="short_description" class="text-sm font-medium text-zinc-900 dark:text-white">Short description <span class="font-normal text-zinc-500">(optional)</span></label><input id="short_description" name="short_description" type="text" maxlength="255" value="{{ old('short_description', $product?->short_description) }}" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-white dark:focus:ring-white">@error('short_description')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror</div>
        <div class="lg:col-span-2"><label for="description" class="text-sm font-medium text-zinc-900 dark:text-white">Full description <span class="font-normal text-zinc-500">(optional)</span></label><textarea id="description" name="description" rows="6" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-white dark:focus:ring-white">{{ old('description', $product?->description) }}</textarea>@error('description')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror</div>
        <div class="lg:col-span-2"><label for="images" class="text-sm font-medium text-zinc-900 dark:text-white">Product images <span class="font-normal text-zinc-500">(JPG, PNG, or WebP; up to 5 MB each)</span></label><input id="images" name="images[]" type="file" accept="image/jpeg,image/png,image/webp" multiple class="mt-2 block w-full rounded-lg border border-zinc-300 bg-white text-sm text-zinc-700 file:mr-4 file:border-0 file:bg-zinc-100 file:px-4 file:py-2.5 file:text-sm file:font-medium file:text-zinc-700 hover:file:bg-zinc-200 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:file:bg-zinc-700 dark:file:text-zinc-100 dark:hover:file:bg-zinc-600">@error('images')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror @error('images.*')<p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>@enderror</div>
        <div class="flex flex-wrap gap-6 lg:col-span-2"><label class="flex items-center gap-2 text-sm font-medium text-zinc-900 dark:text-white"><input name="is_active" type="checkbox" value="1" @checked(old('is_active', $product?->is_active ?? true)) class="rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900 dark:border-zinc-600 dark:bg-zinc-800 dark:focus:ring-white">Show this product in the shop</label><label class="flex items-center gap-2 text-sm font-medium text-zinc-900 dark:text-white"><input name="is_featured" type="checkbox" value="1" @checked(old('is_featured', $product?->is_featured ?? false)) class="rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900 dark:border-zinc-600 dark:bg-zinc-800 dark:focus:ring-white">Mark as featured</label></div>
    </div>
    <div class="flex items-center justify-end gap-3"><a href="{{ route('admin.products.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white">Cancel</a><button type="submit" class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">{{ $product ? 'Save changes' : 'Create product' }}</button></div>
</form>

<script>
        document.addEventListener('DOMContentLoaded', () => {
            const parentCategory = document.getElementById('parent_category_id');
            const subcategory = document.getElementById('category_id');
            const options = Array.from(subcategory.options).slice(1);
            const initialValue = @js($selectedCategoryId);

            const filterSubcategories = (preserveSelection = false) => {
                const parentId = parentCategory.value;

                options.forEach((option) => {
                    const belongsToParent = option.dataset.parentId === parentId;
                    option.hidden = ! belongsToParent;
                    option.disabled = ! belongsToParent;
                });

                subcategory.disabled = parentId === '';
                subcategory.options[0].textContent = parentId === ''
                    ? 'Choose a product category first'
                    : 'Select a subcategory';

                if (preserveSelection && options.some((option) => option.value === initialValue && ! option.disabled)) {
                    subcategory.value = initialValue;
                } else {
                    subcategory.value = '';
                }
            };

            parentCategory.addEventListener('change', () => filterSubcategories());
            filterSubcategories(true);
        });
</script>
