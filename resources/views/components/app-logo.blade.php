@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand :name="config('app.name', 'Laravel')" {{ $attributes }}>
        <x-slot name="logo" class="flex size-9 items-center justify-center overflow-hidden rounded-md bg-white">
            <img src="{{ asset('images/curtains-kenya-logo.png') }}" alt="Curtains Kenya" class="h-full w-full object-contain">
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand :name="config('app.name', 'Laravel')" {{ $attributes }}>
        <x-slot name="logo" class="flex size-9 items-center justify-center overflow-hidden rounded-md bg-white">
            <img src="{{ asset('images/curtains-kenya-logo.png') }}" alt="Curtains Kenya" class="h-full w-full object-contain">
        </x-slot>
    </flux:brand>
@endif
