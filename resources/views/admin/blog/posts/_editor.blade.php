@php($editorContent = \App\Support\BlogContent::toEditorHtml(old('content', $post?->content ?? '')))

<div
    data-blog-editor
    data-upload-url="{{ route('admin.blog.images.store') }}"
    data-csrf-token="{{ csrf_token() }}"
    data-existing-featured-image="{{ $post?->imageUrl() }}"
>
    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <label for="content" class="text-sm font-medium dark:text-white">Article content</label>
            <p class="mt-1 text-xs text-zinc-500">Format visually using the toolbar. Use one clear article title above, then H2–H4 headings inside the article.</p>
        </div>
        <button type="button" data-editor-preview-open class="rounded-lg border border-zinc-300 px-3 py-2 text-xs font-semibold text-zinc-700 transition hover:bg-zinc-50 focus-visible:outline-2 focus-visible:outline-offset-2 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Preview article</button>
    </div>

    <div class="blog-editor-shell mt-3">
        <div data-editor-toolbar class="blog-editor-toolbar" role="toolbar" aria-label="Article formatting controls"></div>
        <div data-editor-surface class="blog-editor-surface" aria-label="Article content editor"></div>
        <textarea id="content" name="content" required class="sr-only" tabindex="-1">{{ $editorContent }}</textarea>
        <input data-editor-image-input type="file" accept="image/jpeg,image/png,image/webp" class="sr-only" tabindex="-1">
        <div class="blog-editor-status" aria-live="polite">
            <span><strong data-editor-words>0</strong> words</span>
            <span><strong data-editor-characters>0</strong> characters</span>
            <span><strong data-editor-reading-time>1</strong> min read</span>
            <span data-editor-save-status>Ready</span>
        </div>
    </div>

    @error('content')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    <dialog data-editor-preview class="m-auto max-h-[90vh] w-[min(62rem,calc(100%-2rem))] rounded-2xl bg-white p-0 shadow-2xl backdrop:bg-black/50 dark:bg-zinc-900">
        <div class="sticky top-0 z-10 flex items-center justify-between border-b border-zinc-200 bg-white px-5 py-4 dark:border-zinc-700 dark:bg-zinc-900">
            <div><p class="text-xs font-semibold tracking-wide text-zinc-500 uppercase">Article preview</p><h2 data-editor-preview-title class="mt-1 font-serif text-xl text-zinc-900 dark:text-white">Untitled article</h2></div>
            <button type="button" data-editor-preview-close aria-label="Close article preview" class="rounded-lg border border-zinc-300 px-3 py-2 text-sm dark:border-zinc-600 dark:text-white">Close</button>
        </div>
        <article class="mx-auto max-w-3xl px-6 py-8 sm:px-10">
            <p data-editor-preview-meta class="mb-5 text-sm text-zinc-500"></p>
            <img data-editor-preview-image src="" alt="" class="mb-8 hidden max-h-[30rem] w-full rounded-xl object-cover">
            <div data-editor-preview-body class="prose prose-zinc max-w-none overflow-x-auto prose-img:h-auto prose-img:max-w-full prose-table:min-w-[36rem] dark:prose-invert"></div>
        </article>
    </dialog>
</div>
