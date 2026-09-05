<x-layouts::app :title="__('Add subcategory')">
    <div class="mx-auto w-full max-w-4xl p-4 sm:p-6 lg:p-8">
        <div class="border-b border-zinc-200 pb-6 dark:border-zinc-700">
            <a href="{{ route('admin.subcategories.index') }}" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">← Back to subcategories</a>
            <h1 class="mt-3 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Add subcategory</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Create a collection within one of your main shop categories.</p>
        </div>

        @include('admin.categories._form', ['category' => null, 'subcategoryMode' => true])
    </div>
</x-layouts::app>
