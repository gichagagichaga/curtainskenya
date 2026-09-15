<div class="grid gap-3 p-3 sm:grid-cols-3">
    @foreach(['alt' => 'Alternative text', 'title' => 'Image title (optional)', 'caption' => 'Caption (optional)'] as $suffix => $label)
        @continue($suffix === 'alt' && ($skipAlt ?? false))
        @php($field = ($prefix ?? 'image_').$suffix)
        <label class="block text-sm">{{ $label }}<input name="{{ $field }}" value="{{ old($field, $record?->{$field} ?? '') }}" maxlength="255" class="mt-1 block w-full rounded border border-zinc-300 p-2 dark:bg-zinc-800 dark:text-white">@error($field)<span class="text-red-600">{{ $message }}</span>@enderror</label>
    @endforeach
</div>
