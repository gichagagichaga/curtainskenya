

<?php $__env->startSection('title', 'Curtains Kenya | Curtains, Blinds & Installation'); ?>

<?php $__env->startSection('description', 'Explore made-to-measure curtains, blinds, bedding and furnishing fabrics, with measurement and installation support across Kenya.'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $categoryImages = [
        'curtains' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85',
        'blinds' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=900&q=85',
        'bednets' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85',
        'bedding' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85',
        'seat-covers' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=900&q=85',
        'toiletry' => 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=900&q=85',
        'fabrics' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=900&q=85',
        'accessories' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=900&q=85',
    ];
?>

<section class="ck-hero">
    <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(38,34,29,.75),rgba(38,34,29,.32)_48%,rgba(38,34,29,.08))]"></div>
    <div class="ck-container relative flex min-h-[min(720px,calc(100svh-80px))] items-end py-14 sm:py-20 lg:py-24">
        <div class="max-w-2xl text-white">
            <p class="ck-eyebrow text-white/70">Window solutions for Kenyan spaces</p>
            <h1 class="mt-5 font-serif text-5xl leading-[0.94] tracking-[-0.055em] sm:text-6xl lg:text-8xl">Shade, privacy<br><em class="font-light">and a better finish.</em></h1>
            <p class="mt-7 max-w-md text-base leading-7 text-white/80 sm:text-lg">Choose curtains, blinds and soft furnishings with practical guidance from measurement through fitting.</p>
            <div class="mt-9 flex flex-wrap gap-3">
                <a href="#categories" class="ck-button bg-white text-ck-dark hover:bg-ck-cream">Explore collections <span class="ml-4">↓</span></a>
                <a href="#featured" class="ck-button-outline border-white text-white hover:border-white hover:bg-white hover:text-ck-dark">Featured pieces</a>
            </div>
        </div>
    </div>
</section>

<section class="border-b border-black/8 bg-ck-cream">
    <div class="ck-container grid gap-6 py-6 text-center text-[0.62rem] font-medium tracking-[0.16em] text-ck-brown uppercase sm:grid-cols-3 sm:gap-0">
        <span>Made-to-measure options</span><span class="sm:border-x sm:border-black/10">Quotation support</span><span>Delivery and installation</span>
    </div>
</section>

<section id="categories" class="ck-section scroll-mt-28">
    <div class="ck-container">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="ck-eyebrow">Shop by need</p>
                <h2 class="ck-heading mt-3 font-serif">Find the right finish for every room.</h2>
            </div>
            <p class="max-w-xs text-sm leading-6 text-ck-brown">Light control, privacy, comfort and colour—organised into useful collections.</p>
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('shop.category', $category)); ?>" class="ck-category-card group">
                    <img src="<?php echo e($category->image ? asset('storage/'.$category->image) : ($categoryImages[$category->slug] ?? 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85')); ?>" alt="<?php echo e($category->name); ?> collection" loading="lazy" class="absolute inset-0 h-full w-full object-cover transition duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-ck-dark/75 via-ck-dark/12 to-transparent"></div>
                    <div class="relative flex h-full flex-col justify-end p-6 text-white">
                        <span class="text-[0.6rem] font-medium tracking-[0.18em] text-white/75 uppercase">Collection</span>
                        <span class="mt-2 flex items-end justify-between font-serif text-3xl tracking-[-0.04em]"><?php echo e($category->name); ?> <span class="translate-y-1 text-lg transition-transform group-hover:-translate-y-1">↗</span></span>
                    </div>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>

<section id="featured" class="ck-section scroll-mt-28 bg-ck-cream">
    <div class="ck-container">
        <div class="text-center">
            <p class="ck-eyebrow">Popular choices</p>
            <h2 class="ck-heading mt-3 font-serif">Solutions customers return to.</h2>
        </div>

        <div class="mt-10 grid gap-x-5 gap-y-9 sm:grid-cols-2 lg:grid-cols-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                    $image = $product->images->first()?->image_path
                        ? asset('storage/'.$product->images->first()->image_path)
                        : ($categoryImages[$product->category->slug] ?? 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&w=900&q=85');
                    $price = $product->sale_price ?? $product->price;
                ?>
                <article class="group">
                    <a href="<?php echo e(route('products.show', $product)); ?>" class="relative block aspect-[4/5] overflow-hidden bg-ck-beige">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->sale_price): ?>
                            <span class="absolute left-3 top-3 z-10 bg-white px-2.5 py-1 text-[0.58rem] font-medium tracking-[0.15em] text-ck-dark uppercase">Special price</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <img src="<?php echo e($image); ?>" alt="<?php echo e($product->images->first()?->alt_text ?: $product->name); ?>" loading="lazy" class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                    </a>
                    <div class="mt-4 flex items-start justify-between gap-3">
                        <div>
                            <p class="text-[0.58rem] font-medium tracking-[0.16em] text-ck-brown uppercase"><?php echo e($product->category->name); ?></p>
                            <h3 class="mt-1 font-serif text-xl leading-6 tracking-[-0.025em]"><a href="<?php echo e(route('products.show', $product)); ?>" class="transition hover:text-ck-brown"><?php echo e($product->name); ?></a></h3>
                        </div>
                        <p class="shrink-0 text-sm">KES <?php echo e(number_format((float) $price)); ?></p>
                    </div>
                </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>

<section id="services" class="ck-section scroll-mt-28">
    <div class="ck-container">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div><p class="ck-eyebrow">From idea to installation</p><h2 class="ck-heading mt-3 font-serif">Help where your project needs it.</h2></div>
            <p class="max-w-xs text-sm leading-6 text-ck-brown">Book measuring, request a fabric consultation or arrange professional fitting.</p>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($services->isNotEmpty()): ?>
            <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <article class="group overflow-hidden rounded-2xl bg-ck-cream">
                        <a href="<?php echo e(route('services.show', $service)); ?>" class="block" aria-label="Explore <?php echo e($service->name); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->images->first()): ?>
                                <img src="<?php echo e(asset('storage/'.$service->images->first()->image_path)); ?>" alt="<?php echo e($service->name); ?>" loading="lazy" class="aspect-[4/3] w-full object-cover transition duration-700 group-hover:scale-105">
                            <?php else: ?>
                                <div class="flex aspect-[4/3] items-center justify-center bg-ck-beige px-6 text-center font-serif text-3xl text-ck-dark/65"><?php echo e($service->name); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </a>
                        <div class="p-6"><p class="text-[0.6rem] font-medium tracking-[0.16em] text-ck-brown uppercase">Curtains Kenya service</p><h3 class="mt-2 font-serif text-2xl tracking-[-0.035em]"><a href="<?php echo e(route('services.show', $service)); ?>" class="transition hover:text-ck-brown"><?php echo e($service->name); ?></a></h3><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->short_description): ?><p class="mt-3 text-sm leading-6 text-ck-brown"><?php echo e(\Illuminate\Support\Str::limit($service->short_description, 150)); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><a href="<?php echo e(route('services.show', $service)); ?>" class="mt-5 inline-flex border-b border-ck-dark pb-1 text-[0.65rem] font-medium tracking-[0.14em] uppercase">Explore service <span class="ml-4">↗</span></a></div>
                    </article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        <?php else: ?>
            <p class="mt-8 text-sm leading-7 text-ck-brown">Our service offerings will be added here soon.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section>

<section id="about" class="ck-section scroll-mt-28">
    <div class="ck-container grid items-center gap-10 lg:grid-cols-2 lg:gap-20">
        <div class="relative aspect-[4/5] overflow-hidden bg-ck-beige">
            <img src="<?php echo e($story?->image ? asset('storage/'.$story->image) : 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1200&q=85'); ?>" alt="<?php echo e($story?->image_alt ?: 'Warm, texture-led living space'); ?>" loading="lazy" class="h-full w-full object-cover">
            <div class="absolute bottom-0 left-0 bg-white px-5 py-4 text-[0.6rem] font-medium tracking-[0.15em] text-ck-dark uppercase">Thoughtful textures, calm spaces</div>
        </div>
        <div class="max-w-lg">
            <p class="ck-eyebrow"><?php echo e($story?->eyebrow ?: 'The Curtains Kenya way'); ?></p>
            <h2 class="ck-heading mt-3 font-serif"><?php echo e($story?->title ?: 'The details change everything.'); ?></h2>
            <p class="mt-6 text-base leading-8 text-ck-brown"><?php echo e($story?->intro ?: 'A room begins to feel like yours in its softest layers: the light through a curtain, the weight of a bedcover, a fabric that wears beautifully over time.'); ?></p>
            <p class="mt-4 text-sm leading-7 text-ck-brown"><?php echo e($story?->body ?: 'We bring together practical pieces and lasting finishes so you can create a home that works hard and welcomes softly.'); ?></p>
            <a href="<?php echo e(route('story')); ?>" class="mt-8 inline-flex border-b border-ck-dark pb-1 text-[0.68rem] font-medium tracking-[0.15em] uppercase">Discover our story <span class="ml-5">↗</span></a>
        </div>
    </div>
</section>

<section class="overflow-hidden bg-ck-beige py-10 sm:py-14">
    <div class="ck-container text-center">
        <p class="ck-eyebrow">Our clients</p>
        <h2 class="mt-3 font-serif text-4xl tracking-[-0.04em] sm:text-5xl">Trusted by discerning spaces.</h2>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($clients->isNotEmpty()): ?>
        <div class="mt-8 overflow-hidden" aria-label="Our clients">
            <div class="ck-marquee-track ck-marquee-track-slow">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <article class="ck-key-client-slide"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($client->image): ?><img src="<?php echo e(asset('storage/'.$client->image)); ?>" alt="<?php echo e($client->name); ?> logo or project" class="ck-key-client-logo"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><span><?php echo e($client->name); ?></span></article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <p class="mx-auto mt-5 max-w-xl px-6 text-center text-sm leading-7 text-ck-brown">Add your client partners in the admin panel to show them here.</p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="ck-container mt-10 border-t border-ck-dark/10 pt-8 text-center">
        <p class="ck-eyebrow">Happy clients</p>
        <h2 class="mx-auto mt-3 max-w-3xl font-serif text-3xl leading-[1.02] tracking-[-0.045em] sm:text-4xl">Homes made happier.</h2>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonials->isNotEmpty()): ?>
        <div class="ck-testimonial-slider-compact mt-6 overflow-hidden" aria-label="Customer testimonials">
            <div class="ck-marquee-track"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [$testimonials, $testimonials]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonialSet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $testimonialSet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><article class="ck-testimonial-slide"><div class="text-sm tracking-[0.15em] text-[#b48a4a]"><?php echo e(str_repeat('★', $testimonial->rating)); ?></div><p class="mt-4 font-serif text-xl leading-7 text-ck-dark">“<?php echo e($testimonial->review); ?>”</p><p class="mt-5 text-xs font-medium tracking-[0.14em] text-ck-brown uppercase"><?php echo e($testimonial->customer_name); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonial->location): ?> · <?php echo e($testimonial->location); ?><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></p></article><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
        </div>
    <?php else: ?>
        <p class="mx-auto mt-7 max-w-xl px-6 text-center text-sm leading-7 text-ck-brown">Customer reviews will appear here as soon as they are published.</p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</section>

<style>
    .ck-testimonial-slider-compact .ck-testimonial-slide { min-height: 0; padding: 1.25rem 1.5rem; }
    .ck-testimonial-slider-compact .ck-testimonial-slide p { margin-top: 0.75rem; }
    .ck-client-gallery { display: flex; gap: 1rem; overflow-x: auto; padding: 0.25rem 1rem 1rem; scroll-snap-type: x mandatory; scrollbar-width: thin; }
    .ck-key-client-slide { display: flex; min-height: 11rem; flex: 0 0 min(18rem, 82vw); flex-direction: column; align-items: center; justify-content: center; gap: 0.9rem; border: 1px solid rgb(38 34 29 / 10%); background: white; padding: 1.25rem; text-align: center; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; scroll-snap-align: start; }
    .ck-key-client-logo { height: 7.5rem; width: 100%; object-fit: contain; }
    .ck-client-logo-slider { position: relative; margin-inline: auto; width: min(100% - 2rem, 34rem); }
    .ck-client-logo-slider .ck-key-client-slide { min-height: 15rem; width: 100%; flex-basis: 100%; }
    .ck-client-logo-slider .ck-key-client-logo { height: 10rem; }
    .ck-client-slider-control { position: absolute; top: 50%; z-index: 1; transform: translateY(-50%); border-radius: 9999px; background: rgb(255 255 255 / 90%); padding: 0.55rem 0.8rem; color: var(--color-ck-dark); box-shadow: 0 3px 12px rgb(0 0 0 / 12%); }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\resources\views/home.blade.php ENDPATH**/ ?>