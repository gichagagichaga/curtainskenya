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
            <p class="mt-1 text-xs text-zinc-500">Format visually using the toolbar. You can paste from Microsoft Word; headings, paragraphs, emphasis, alignment, lists and tables are cleaned into semantic HTML.</p>
        </div>
        <button type="button" data-editor-preview-open class="rounded-lg border border-zinc-300 px-3 py-2 text-xs font-semibold text-zinc-700 transition hover:bg-zinc-50 focus-visible:outline-2 focus-visible:outline-offset-2 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Preview article</button>
    </div>

    <div class="blog-editor-shell mt-3">
        <div data-editor-toolbar class="blog-editor-toolbar" role="toolbar" aria-label="Article formatting controls"></div>
        <div data-editor-surface class="blog-editor-surface" aria-label="Article content editor"></div>
        <textarea id="content" name="content" required class="sr-only" tabindex="-1">{{ $editorContent }}</textarea>
        <div class="blog-editor-status" aria-live="polite">
            <span><strong data-editor-words>0</strong> words</span>
            <span><strong data-editor-characters>0</strong> characters</span>
            <span><strong data-editor-reading-time>1</strong> min read</span>
            <span data-editor-save-status>Ready</span>
        </div>
    </div>

    @error('content')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

    <dialog data-editor-image-dialog class="m-auto w-[min(32rem,calc(100%-2rem))] rounded-2xl bg-white p-0 shadow-2xl backdrop:bg-black/50 dark:bg-zinc-900">
        <div class="border-b border-zinc-200 px-5 py-4 dark:border-zinc-700">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Insert article image</h2>
            <p class="mt-1 text-sm text-zinc-500">JPEG, PNG or WebP, up to 5 MB. Alt text is required for accessibility and SEO.</p>
        </div>
        <div class="grid gap-4 px-5 py-5">
            <div><label for="editor-image-file" class="text-sm font-medium dark:text-white">Image file</label><input id="editor-image-file" data-editor-image-input type="file" accept="image/jpeg,image/png,image/webp" class="mt-2 block w-full text-sm dark:text-zinc-200"></div>
            <div><label for="editor-image-alt" class="text-sm font-medium dark:text-white">Alt text</label><input id="editor-image-alt" data-editor-image-alt maxlength="255" placeholder="Describe what is shown in the image" class="mt-2 w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"></div>
            <div><label for="editor-image-title" class="text-sm font-medium dark:text-white">Image title <span class="font-normal text-zinc-500">(optional)</span></label><input id="editor-image-title" data-editor-image-title maxlength="255" placeholder="Optional title or caption" class="mt-2 w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"></div>
            <p data-editor-image-error class="hidden text-sm text-red-600" role="alert"></p>
        </div>
        <div class="flex justify-end gap-3 border-t border-zinc-200 px-5 py-4 dark:border-zinc-700">
            <button type="button" data-editor-image-cancel class="rounded-lg border border-zinc-300 px-4 py-2 text-sm dark:border-zinc-600 dark:text-white">Cancel</button>
            <button type="button" data-editor-image-submit class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-semibold text-white disabled:cursor-wait disabled:opacity-60 dark:bg-white dark:text-zinc-900">Upload and insert</button>
        </div>
    </dialog>

    <dialog data-editor-link-dialog class="m-auto w-[min(32rem,calc(100%-2rem))] rounded-2xl bg-white p-0 shadow-2xl backdrop:bg-black/50 dark:bg-zinc-900">
        <div class="border-b border-zinc-200 px-5 py-4 dark:border-zinc-700"><h2 class="text-lg font-semibold text-zinc-900 dark:text-white">Add or edit link</h2><p class="mt-1 text-sm text-zinc-500">Internal links can start with /, for example /shop or /contact.</p></div>
        <div class="grid gap-4 px-5 py-5">
            <div><label for="editor-link-url" class="text-sm font-medium dark:text-white">Link URL</label><input id="editor-link-url" data-editor-link-url placeholder="https:// or /page" class="mt-2 w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"></div>
            <div><label for="editor-link-text" class="text-sm font-medium dark:text-white">Link text</label><input id="editor-link-text" data-editor-link-text maxlength="255" class="mt-2 w-full rounded-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"></div>
            <label class="flex items-center gap-2 text-sm dark:text-white"><input data-editor-link-new-tab type="checkbox"> Open in a new tab</label>
            <p data-editor-link-error class="hidden text-sm text-red-600" role="alert"></p>
        </div>
        <div class="flex justify-end gap-3 border-t border-zinc-200 px-5 py-4 dark:border-zinc-700">
            <button type="button" data-editor-link-cancel class="rounded-lg border border-zinc-300 px-4 py-2 text-sm dark:border-zinc-600 dark:text-white">Cancel</button>
            <button type="button" data-editor-link-submit class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-semibold text-white dark:bg-white dark:text-zinc-900">Apply link</button>
        </div>
    </dialog>

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
