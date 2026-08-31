<x-layouts::app :title="__('Add service')">
    <div class="mx-auto w-full max-w-4xl p-4 sm:p-6 lg:p-8">
        <div class="border-b border-zinc-200 pb-6 dark:border-zinc-700"><a href="{{ route('admin.services.index') }}" class="text-sm font-medium text-ck-blue">← Services</a><h1 class="mt-3 text-2xl font-semibold text-zinc-900 dark:text-white">Add service</h1><p class="mt-1 text-sm text-zinc-500">This becomes a selectable offering in the public Services dropdown.</p></div>
        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="mt-6 rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">@csrf @include('admin.services._form')<div class="mt-8 flex justify-end gap-3"><a href="{{ route('admin.services.index') }}" class="rounded-lg px-4 py-2.5 text-sm font-medium text-zinc-700 dark:text-zinc-200">Cancel</a><button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white dark:bg-white dark:text-zinc-900">Create service</button></div></form>
    </div>
</x-layouts::app>
