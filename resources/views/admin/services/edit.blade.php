<x-layouts::app :title="__('Edit service')">
    <div class="mx-auto w-full max-w-4xl p-4 sm:p-6 lg:p-8">
        <div class="flex items-start justify-between gap-4 border-b border-zinc-200 pb-6 dark:border-zinc-700"><div><a href="{{ route('admin.services.index') }}" class="text-sm font-medium text-ck-blue">← Services</a><h1 class="mt-3 text-2xl font-semibold text-zinc-900 dark:text-white">Edit {{ $service->name }}</h1></div><a href="{{ route('services.show', $service) }}" target="_blank" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 dark:border-zinc-600 dark:text-zinc-100">Preview</a></div>
        @if(session('status'))<div class="mt-6 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data" class="mt-6 rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">@csrf @method('PUT') @include('admin.services._form')<div class="mt-8 flex justify-end"><button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white dark:bg-white dark:text-zinc-900">Save changes</button></div></form>
    </div>
</x-layouts::app>
