<form method="POST" action="{{ $category ? route('admin.categories.update', $category) : route('admin.categories.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    @if ($category) @method('PUT') @endif

    <div class="grid gap-6 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 sm:p-6">
        <div>
            <label for="name" class="text-sm font-medium text-zinc-900 dark:text-white">Category name</label>
            <input id="name" name="name" type="text" required value="{{ old('name', $category?->name) }}" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
            @error('name') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="parent_id" class="text-sm font-medium text-zinc-900 dark:text-white">Parent category <span class="font-normal text-zinc-500">(optional)</span></label>
            <select id="parent_id" name="parent_id" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                <option value="">None — make this a main category</option>
                @foreach ($parentCategories as $parentCategory)
                    <option value="{{ $parentCategory->id }}" @selected((string) old('parent_id', $category?->parent_id) === (string) $parentCategory->id)>{{ $parentCategory->name }}</option>
                @endforeach
            </select>
            <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">Select a main category to create this as its subcategory.</p>
            @error('parent_id') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="sort_order" class="text-sm font-medium text-zinc-900 dark:text-white">Display order</label>
            <input id="sort_order" name="sort_order" type="number" min="0" required value="{{ old('sort_order', $category?->sort_order ?? 0) }}" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
            @error('sort_order') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="text-sm font-medium text-zinc-900 dark:text-white">Description <span class="font-normal text-zinc-500">(optional)</span></label>
            <textarea id="description" name="description" rows="5" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">{{ old('description', $category?->description) }}</textarea>
            @error('description') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="image" class="text-sm font-medium text-zinc-900 dark:text-white">Category image <span class="font-normal text-zinc-500">(optional)</span></label>
            @if ($category?->image) <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" class="mt-3 h-36 w-52 rounded-lg object-cover"> @endif
            <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp" class="mt-2 block w-full rounded-lg border border-zinc-300 bg-white text-sm text-zinc-700 file:mr-4 file:border-0 file:bg-zinc-100 file:px-4 file:py-2.5 file:text-sm file:font-medium dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:file:bg-zinc-700 dark:file:text-zinc-100">
            @error('image') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
        </div>

        <label class="flex items-center gap-2 text-sm font-medium text-zinc-900 dark:text-white">
            <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $category?->is_active ?? true)) class="rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900 dark:border-zinc-600 dark:bg-zinc-800">
            Show this category in the shop
        </label>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.categories.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-600 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white">Cancel</a>
        <button type="submit" class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-zinc-700 dark:bg-white dark:text-zinc-900">{{ $category ? 'Save changes' : 'Create category' }}</button>
    </div>
</form>
