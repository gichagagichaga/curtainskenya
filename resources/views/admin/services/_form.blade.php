<div class="grid gap-6">
    <div>
        <label for="name" class="text-sm font-medium text-zinc-800 dark:text-zinc-100">Service name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $service->name ?? '') }}" required maxlength="255" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" placeholder="e.g. Custom curtain making">
        @error('name')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="short_description" class="text-sm font-medium text-zinc-800 dark:text-zinc-100">Short description</label>
        <textarea id="short_description" name="short_description" rows="3" maxlength="1000" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" placeholder="A short introduction shown in the Services menu.">{{ old('short_description', $service->short_description ?? '') }}</textarea>
        @error('short_description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="description" class="text-sm font-medium text-zinc-800 dark:text-zinc-100">Detailed description</label>
        <textarea id="description" name="description" rows="12" required maxlength="5000" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" placeholder="Explain what this service includes, who it is for, and how Curtains Kenya can help.">{{ old('description', $service->description ?? '') }}</textarea>
        <p class="mt-2 text-xs text-zinc-500">Paragraphs are preserved on the public service page.</p>
        @error('description')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="images" class="text-sm font-medium text-zinc-800 dark:text-zinc-100">Service gallery</label>
        @if(isset($service) && $service->images->isNotEmpty())
            <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-3">
                @foreach($service->images as $image)
                    <div class="relative overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700"><img src="{{ asset('storage/'.$image->image_path) }}" alt="" class="h-28 w-full object-cover"><form method="POST" action="{{ route('admin.services.images.destroy', [$service, $image]) }}" onsubmit="return confirm('Remove this image?')" class="absolute right-2 top-2">@csrf @method('DELETE')<button class="rounded-md bg-white/90 px-2 py-1 text-xs font-medium text-red-700 shadow">Remove</button></form></div>
                @endforeach
            </div>
        @endif
        <input id="images" name="images[]" type="file" accept="image/jpeg,image/png,image/webp" multiple class="mt-3 block w-full text-sm text-zinc-600 dark:text-zinc-300">
        <p class="mt-2 text-xs text-zinc-500">Choose up to 8 JPG, PNG, or WebP images (5 MB each). They appear in upload order in the public slider.</p>
        @error('images')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        @error('images.*')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="grid gap-6 sm:grid-cols-[12rem_1fr] sm:items-end">
        <div>
            <label for="sort_order" class="text-sm font-medium text-zinc-800 dark:text-zinc-100">Display order</label>
            <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $service->sort_order ?? 0) }}" class="mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
            @error('sort_order')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <label class="flex items-center gap-3 rounded-lg border border-zinc-200 p-3 text-sm text-zinc-700 dark:border-zinc-700 dark:text-zinc-200">
            <input name="is_active" type="checkbox" value="1" @checked(old('is_active', $service->is_active ?? true)) class="rounded border-zinc-300 text-ck-blue focus:ring-blue-500">
            Show this service in the public Services menu
        </label>
    </div>
</div>
