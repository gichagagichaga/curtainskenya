<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Platform')" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700" wire:navigate>
                        {{ __('Dashboard') }}
                    </flux:sidebar.item>

                    @if(auth()->user()->hasRole(\App\Models\User::ROLE_CATALOGUE_MANAGER))
                    <flux:sidebar.item icon="layout-grid" :href="route('admin.products.index')" :current="request()->routeIs('admin.products.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Products') }}
                    </flux:sidebar.item>
                    @endif

                    @if(auth()->user()->hasRole(\App\Models\User::ROLE_CATALOGUE_MANAGER))
                    <flux:sidebar.item icon="folder-git-2" :href="route('admin.categories.index')" :current="request()->routeIs('admin.categories.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Categories') }}
                    </flux:sidebar.item>
                    @endif
                    @if(auth()->user()->hasRole(\App\Models\User::ROLE_CONTENT_MANAGER))
                    <flux:sidebar.item icon="book-open-text" :href="route('admin.blog.posts.index')" :current="request()->routeIs('admin.blog.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Blog') }}
                    </flux:sidebar.item>
                    @endif
                    @if(auth()->user()->hasRole(\App\Models\User::ROLE_CUSTOMER_SERVICE))
                    <flux:sidebar.item icon="envelope" :href="route('admin.enquiries.index')" :current="request()->routeIs('admin.enquiries.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Enquiries') }}
                    </flux:sidebar.item>
                    @endif
                    @if(auth()->user()->hasRole(\App\Models\User::ROLE_ORDERS_MANAGER))
                    <flux:sidebar.item icon="clipboard-document-list" :href="route('admin.orders.index')" :current="request()->routeIs('admin.orders.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Orders') }}
                    </flux:sidebar.item>
                    @endif
                    @if(auth()->user()->hasRole(\App\Models\User::ROLE_CONTENT_MANAGER))
                    <flux:sidebar.item icon="heart" :href="route('admin.story.edit')" :current="request()->routeIs('admin.story.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Our story') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="chat-bubble-left-right" :href="route('admin.testimonials.index')" :current="request()->routeIs('admin.testimonials.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Testimonials') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="building-office-2" :href="route('admin.clients.index')" :current="request()->routeIs('admin.clients.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Our clients') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="wrench-screwdriver" :href="route('admin.services.index')" :current="request()->routeIs('admin.services.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Services') }}
                    </flux:sidebar.item>
                    @endif
                    @if(auth()->user()->hasRole(\App\Models\User::ROLE_SUPER_ADMIN))
                    <flux:sidebar.item icon="users" :href="route('admin.users.index')" :current="request()->routeIs('admin.users.*')" class="data-current:!bg-ck-blue data-current:!text-white data-current:hover:!bg-blue-700">
                        {{ __('Administrators') }}
                    </flux:sidebar.item>
                    @endif
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    {{ __('Repository') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank">
                    {{ __('Documentation') }}
                </flux:sidebar.item>
            </flux:sidebar.nav>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
