@if($record && $record->images->isNotEmpty())
<fieldset class="grid gap-3 rounded border p-3"><legend>Existing image descriptions</legend>
@foreach($record->images as $image)
    <div class="grid gap-2 border-b pb-3">
        <p class="text-sm">{{ basename($image->image_path) }}</p>
        @foreach(['alt_text' => 'Alternative text', 'image_title' => 'Title (optional)', 'image_caption' => 'Caption (optional)'] as $field => $label)
            <label class="text-sm">{{ $label }}<input name="existing_image_metadata[{{ $image->id }}][{{ $field }}]" value="{{ old('existing_image_metadata.'.$image->id.'.'.$field, $image->{$field}) }}" maxlength="255" class="block w-full rounded border p-2 dark:bg-zinc-800"></label>
        @endforeach
    </div>
@endforeach
</fieldset>
@endif
