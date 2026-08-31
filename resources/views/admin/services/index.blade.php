<x-layouts::app :title="__('Services')">
    <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
        <div class="flex items-center justify-between border-b border-zinc-200 pb-6 dark:border-zinc-700">
            <div><p class="text-sm text-zinc-500">Public website offerings</p><h1 class="mt-1 text-2xl font-semibold text-zinc-900 dark:text-white">Services</h1></div>
            <a href="{{ route('admin.services.create') }}" class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white dark:bg-white dark:text-zinc-900">Add service</a>
        </div>
        @if(session('status'))<div class="mt-6 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('status') }}</div>@endif
        <div class="mt-6 overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse($services as $service)
                    <article class="flex flex-col gap-4 p-5 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex gap-4">@if($service->images->first())<img src="{{ asset('storage/'.$service->images->first()->image_path) }}" alt="" class="size-16 rounded-lg object-cover">@endif<div><div class="flex items-center gap-3"><h2 class="font-semibold text-zinc-900 dark:text-white">{{ $service->name }}</h2><span class="rounded-full px-2.5 py-1 text-xs {{ $service->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-100 text-zinc-600' }}">{{ $service->is_active ? 'Visible' : 'Hidden' }}</span></div><p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600 dark:text-zinc-300">{{ $service->short_description ?: Str::limit($service->description, 150) }}</p><p class="mt-2 text-xs text-zinc-500">{{ $service->images->count() }} {{ Str::plural('image', $service->images->count()) }} · Display order: {{ $service->sort_order }}</p></div></div>
                        <div class="flex shrink-0 items-center gap-4"><a href="{{ route('services.show', $service) }}" target="_blank" class="text-sm font-medium text-ck-blue">View</a><a href="{{ route('admin.services.edit', $service) }}" class="text-sm font-medium text-zinc-900 dark:text-white">Edit</a><form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">@csrf @method('DELETE')<button class="text-sm font-medium text-red-600">Delete</button></form></div>
                    </article>
                @empty
                    <div class="p-12 text-center text-zinc-500">No services yet. Add your first offering to show it in the public menu.</div>
                @endforelse
            </div>
        </div>
        @if($services->hasPages())<div class="mt-6">{{ $services->links() }}</div>@endif
    </div>
</x-layouts::app>
