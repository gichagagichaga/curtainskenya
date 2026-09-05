<x-layouts::app :title="__('Subcategories')">
    <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col gap-4 border-b border-zinc-200 pb-6 dark:border-zinc-700 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Curtains Kenya catalogue</p>
                <h1 class="mt-1 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Subcategories</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Manage the collections grouped beneath your main categories.</p>
            </div>
            <a href="{{ route('admin.subcategories.create') }}" class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">Add subcategory</a>
        </div>

        @if (session('status'))<div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950/40 dark:text-emerald-300">{{ session('status') }}</div>@endif

        <div class="mt-6 overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            @if ($subcategories->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 text-left text-sm dark:divide-zinc-700">
                        <thead class="bg-zinc-50 text-xs font-medium tracking-wide text-zinc-500 uppercase dark:bg-zinc-800/60 dark:text-zinc-400"><tr><th class="px-4 py-3 sm:px-6">Subcategory</th><th class="px-4 py-3">Parent category</th><th class="px-4 py-3">Products</th><th class="px-4 py-3">Order</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right sm:px-6">Actions</th></tr></thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            @foreach ($subcategories as $subcategory)
                                <tr class="text-zinc-700 dark:text-zinc-200" wire:key="subcategory-{{ $subcategory->id }}">
                                    <td class="px-4 py-4 font-medium text-zinc-900 dark:text-white sm:px-6">{{ $subcategory->name }}</td>
                                    <td class="px-4 py-4">{{ $subcategory->parent->name }}</td>
                                    <td class="px-4 py-4">{{ $subcategory->products_count }}</td>
                                    <td class="px-4 py-4">{{ $subcategory->sort_order }}</td>
                                    <td class="px-4 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-medium {{ $subcategory->is_active ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300' }}">{{ $subcategory->is_active ? 'Active' : 'Hidden' }}</span></td>
                                    <td class="px-4 py-4 text-right sm:px-6"><a href="{{ route('admin.categories.edit', $subcategory) }}" class="font-medium text-zinc-900 hover:underline dark:text-white">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($subcategories->hasPages())<div class="border-t border-zinc-200 px-4 py-4 dark:border-zinc-700 sm:px-6">{{ $subcategories->links() }}</div>@endif
            @else
                <div class="px-6 py-16 text-center"><h2 class="text-lg font-semibold text-zinc-900 dark:text-white">No subcategories yet</h2><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Create a subcategory and connect it to a main category.</p></div>
            @endif
        </div>
    </div>
</x-layouts::app>
