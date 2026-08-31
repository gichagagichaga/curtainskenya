<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', 'Curtains Kenya | Made-to-Measure Curtains & Blinds'); ?></title>

    <meta
        name="description"
        content="<?php echo $__env->yieldContent('description', 'Shop and request installation for curtains, blinds, bedding and home textiles from Curtains Kenya.'); ?>"
    >
    <?php ($canonicalUrl = trim($__env->yieldContent('canonical')) ?: url()->current()); ?>
    <?php ($socialImage = trim($__env->yieldContent('og_image')) ?: asset('images/curtains-kenya-logo.png')); ?>
    <meta name="robots" content="<?php echo $__env->yieldContent('robots', 'index,follow'); ?>">
    <link rel="canonical" href="<?php echo e($canonicalUrl); ?>">
    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
    <meta property="og:site_name" content="Curtains Kenya">
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', 'Curtains Kenya | Made-to-Measure Curtains & Blinds'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', 'Window styling, soft furnishings and installation support for Kenyan homes and businesses.'); ?>">
    <meta property="og:url" content="<?php echo e($canonicalUrl); ?>">
    <meta property="og:image" content="<?php echo e($socialImage); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('og_title', 'Curtains Kenya | Made-to-Measure Curtains & Blinds'); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('og_description', 'Window styling, soft furnishings and installation support for Kenyan homes and businesses.'); ?>">
    <meta name="twitter:image" content="<?php echo e($socialImage); ?>">
    <?php ($organizationSchema = ['@'.'context' => 'https://schema.org', '@'.'type' => 'Organization', 'name' => 'Curtains Kenya', 'url' => config('app.url'), 'email' => 'hello@curtainskenya.com', 'logo' => asset('images/curtains-kenya-logo.png')]); ?>
    <script type="application/ld+json"><?php echo e(json_encode($organizationSchema, JSON_UNESCAPED_SLASHES)); ?></script>
    <?php echo $__env->yieldContent('structured_data'); ?>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <style>[x-cloak] { display: none !important; }</style>
</head>

<body class="bg-white text-ck-dark antialiased">
    <?php ($cartItemCount = array_sum(session('cart', []))); ?>
    <div class="bg-ck-dark px-4 py-2.5 text-center text-[0.62rem] font-medium tracking-[0.22em] text-white uppercase sm:text-xs">
        Measured for your space <span class="mx-2 text-white/40">•</span> Delivery and fitting across Kenya
    </div>

    <header class="sticky top-0 z-30 border-b border-black/8 bg-white/95 backdrop-blur">
        <div class="ck-container flex min-h-20 items-center justify-between gap-5">
            <a href="<?php echo e(route('home')); ?>" class="group shrink-0" aria-label="Curtains Kenya home">
                <img src="<?php echo e(asset('images/curtains-kenya-logo.png')); ?>" alt="Curtains Kenya" class="h-14 w-auto max-w-44 object-contain sm:h-16 sm:max-w-52">
            </a>

            <nav class="hidden items-center gap-7 lg:flex" aria-label="Main navigation">
                <a href="<?php echo e(route('home').'#categories'); ?>" class="ck-nav-link ck-section-nav-link" data-section-link="categories">Collections</a>
                <a href="<?php echo e(route('home').'#featured'); ?>" class="ck-nav-link ck-section-nav-link" data-section-link="featured">New arrivals</a>
                <div class="relative flex items-center" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="<?php echo e(route('home').'#services'); ?>" class="ck-nav-link ck-section-nav-link" data-section-link="services">Our services</a>
                    <button type="button" @click="open = ! open" class="ml-1 rounded p-1 text-ck-dark transition hover:bg-ck-cream" :aria-expanded="open.toString()" aria-label="Show services menu"><span class="text-base leading-none" aria-hidden="true">⌄</span></button>
                    <div x-cloak x-show="open" x-transition class="absolute left-0 top-full z-50 mt-3 w-72 rounded-xl border border-black/10 bg-white py-2 shadow-xl">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $navigationServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navigationService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="group relative">
                                <a href="<?php echo e(route('services.show', $navigationService)); ?>" class="block px-4 py-3 text-sm font-medium normal-case tracking-normal text-ck-dark transition hover:bg-[#f3eee7]"><?php echo e($navigationService->name); ?></a>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($navigationService->short_description): ?>
                                    <div class="pointer-events-none absolute left-full top-0 z-50 ml-3 w-64 rounded-xl bg-ck-dark px-4 py-3 text-xs normal-case leading-5 tracking-normal text-white opacity-0 shadow-xl transition-opacity duration-150 group-hover:opacity-100">
                                        <?php echo e($navigationService->short_description); ?>

                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <span class="block px-4 py-3 text-sm normal-case tracking-normal text-ck-dark/60">Services coming soon.</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <a href="<?php echo e(route('story')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['ck-nav-link', 'rounded-md bg-ck-blue px-3 py-2 text-white shadow-sm hover:text-white' => request()->routeIs('story')]); ?>" <?php if(request()->routeIs('story')): ?> aria-current="page" <?php endif; ?>>Our story</a>
                <a href="<?php echo e(route('contact')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['ck-nav-link', 'rounded-md bg-ck-blue px-3 py-2 text-white shadow-sm hover:text-white' => request()->routeIs('contact')]); ?>" <?php if(request()->routeIs('contact')): ?> aria-current="page" <?php endif; ?>>Contact</a>
                <a href="<?php echo e(route('blog.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['ck-nav-link', 'rounded-md bg-ck-blue px-3 py-2 text-white shadow-sm hover:text-white' => request()->routeIs('blog.*')]); ?>" <?php if(request()->routeIs('blog.*')): ?> aria-current="page" <?php endif; ?>>Journal</a>
            </nav>

            <div class="flex items-center gap-3 text-[0.68rem] font-medium tracking-[0.14em] uppercase sm:gap-5">
                <a href="<?php echo e(route('shop.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['hidden hover:text-ck-brown sm:inline', 'rounded-md bg-ck-blue px-3 py-2 text-white shadow-sm hover:text-white' => request()->routeIs('shop.*', 'products.show')]); ?>" <?php if(request()->routeIs('shop.*', 'products.show')): ?> aria-current="page" <?php endif; ?>>Shop</a>
                <a href="<?php echo e(route('cart.index')); ?>" class="flex items-center gap-2 hover:text-ck-brown" aria-label="View your bag">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M5 8h14l-1 12H6L5 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg>
                    <span class="hidden sm:inline">Bag (<?php echo e($cartItemCount); ?>)</span>
                </a>
            </div>
        </div>

        <nav class="flex overflow-x-auto border-t border-black/6 px-4 py-3 lg:hidden" aria-label="Mobile navigation">
            <div class="mx-auto flex min-w-max gap-6 text-[0.65rem] font-medium tracking-[0.14em] uppercase">
                <a href="<?php echo e(route('shop.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['rounded-md px-3 py-2', 'bg-ck-blue text-white shadow-sm' => request()->routeIs('shop.*', 'products.show')]); ?>" <?php if(request()->routeIs('shop.*', 'products.show')): ?> aria-current="page" <?php endif; ?>>Shop</a>
                <a href="<?php echo e(route('home').'#categories'); ?>" class="ck-section-nav-link" data-section-link="categories">Collections</a>
                <a href="<?php echo e(route('home').'#featured'); ?>" class="ck-section-nav-link" data-section-link="featured">New arrivals</a>
                <div class="flex items-center gap-1"><a href="<?php echo e(route('home').'#services'); ?>" class="ck-section-nav-link" data-section-link="services">Our services</a><details class="relative"><summary class="cursor-pointer list-none rounded-md px-2 py-2" aria-label="Show services menu">⌄</summary><div class="absolute left-0 z-50 mt-3 w-72 overflow-hidden rounded-xl border border-black/10 bg-white py-2 shadow-xl"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $navigationServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navigationService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><a href="<?php echo e(route('services.show', $navigationService)); ?>" class="block px-4 py-3 text-sm font-medium normal-case tracking-normal text-ck-dark transition hover:bg-[#f3eee7]"><?php echo e($navigationService->name); ?></a><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?><span class="block px-4 py-3 text-sm normal-case tracking-normal text-ck-dark/60">Services coming soon.</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div></details></div>
                <a href="<?php echo e(route('story')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['rounded-md px-3 py-2', 'bg-ck-blue text-white shadow-sm' => request()->routeIs('story')]); ?>" <?php if(request()->routeIs('story')): ?> aria-current="page" <?php endif; ?>>Our story</a>
                <a href="<?php echo e(route('contact')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['rounded-md px-3 py-2', 'bg-ck-blue text-white shadow-sm' => request()->routeIs('contact')]); ?>" <?php if(request()->routeIs('contact')): ?> aria-current="page" <?php endif; ?>>Contact</a>
                <a href="<?php echo e(route('blog.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['rounded-md px-3 py-2', 'bg-ck-blue text-white shadow-sm' => request()->routeIs('blog.*')]); ?>" <?php if(request()->routeIs('blog.*')): ?> aria-current="page" <?php endif; ?>>Journal</a>
            </div>
        </nav>
    </header>

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer id="contact" class="bg-ck-dark text-white">
        <div class="ck-container grid gap-12 py-16 md:grid-cols-[1.45fr_0.7fr_0.7fr_1fr] md:py-20">
            <div>
                <a href="<?php echo e(route('home')); ?>" class="inline-flex rounded-lg bg-white p-2"><img src="<?php echo e(asset('images/curtains-kenya-logo.png')); ?>" alt="Curtains Kenya" class="h-14 w-auto max-w-48 object-contain"></a>
                <p class="mt-5 max-w-xs text-sm leading-7 text-white/60">Practical window styling and soft furnishings chosen for life in Kenya.</p>
            </div>
            <div>
                <h2 class="ck-footer-heading"><a href="<?php echo e(route('shop.index')); ?>">Shop</a></h2>
                <ul class="ck-footer-list">
                    <li><a href="<?php echo e(route('shop.index')); ?>">Curtains &amp; blinds</a></li>
                    <li><a href="<?php echo e(route('shop.index')); ?>">Bednets &amp; bedding</a></li>
                    <li><a href="<?php echo e(route('shop.index')); ?>">Fabrics &amp; covers</a></li>
                    <li><a href="<?php echo e(route('blog.index')); ?>">Journal</a></li>
                </ul>
            </div>
            <div>
                <h2 class="ck-footer-heading">Service</h2>
                <ul class="ck-footer-list">
                    <li><a href="<?php echo e(route('story')); ?>">About Curtains Kenya</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>">Delivery &amp; care</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>">Talk to us</a></li>
                </ul>
            </div>
            <div>
                <h2 class="ck-footer-heading">A little inspiration</h2>
                <p class="mt-4 text-sm leading-7 text-white/60">Join for thoughtful styling notes and first access to seasonal collections.</p>
                <a href="<?php echo e(route('contact')); ?>" class="mt-5 inline-flex border-b border-white pb-1 text-[0.68rem] font-medium tracking-[0.14em] uppercase">Get in touch <span class="ml-4">↗</span></a>
            </div>
        </div>
        <div class="border-t border-white/15">
            <div class="ck-container flex flex-col gap-2 py-5 text-[0.65rem] tracking-[0.12em] text-white/45 uppercase sm:flex-row sm:justify-between">
                <span>© <?php echo e(date('Y')); ?> Curtains Kenya</span><span>Measured well. Finished beautifully.</span>
            </div>
        </div>
    </footer>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <script>
        const updateSectionNavigation = () => {
            const activeSection = window.location.hash.replace('#', '');

            document.querySelectorAll('[data-section-link]').forEach((link) => {
                const isActive = link.dataset.sectionLink === activeSection;
                link.classList.toggle('is-active', isActive);
                link.toggleAttribute('aria-current', isActive);
            });
        };

        document.addEventListener('DOMContentLoaded', updateSectionNavigation);
        window.addEventListener('hashchange', updateSectionNavigation);
    </script>

</body>
</html>
<?php /**PATH C:\Users\NTATU\Herd\curtainskenya\resources\views/layouts/public.blade.php ENDPATH**/ ?>