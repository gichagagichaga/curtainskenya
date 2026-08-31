<?php $__env->startSection('title', 'Contact Us | Curtains Kenya'); ?>

<?php $__env->startSection('description', 'Contact Curtains Kenya for product enquiries, custom requirements and home textile advice.'); ?>

<?php $__env->startSection('content'); ?>

<section class="bg-[#f3eee7]">
    <div class="mx-auto max-w-7xl px-6 py-16 lg:px-8 lg:py-24">
        <div class="max-w-3xl">
            <p class="text-xs font-semibold tracking-[0.3em] text-[#8a6a4a] uppercase">Curtains Kenya</p>
            <h1 class="mt-4 font-serif text-4xl tracking-tight text-[#29231e] sm:text-5xl lg:text-6xl">Let’s make your space feel like home.</h1>
            <p class="mt-6 max-w-2xl text-base leading-8 text-[#665b52]">Whether you are choosing fabrics, planning custom curtains, or looking for the perfect finishing touch, our team is ready to help.</p>
        </div>
    </div>
</section>

<section class="bg-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-6 py-14 lg:grid-cols-[1.15fr_0.85fr] lg:px-8 lg:py-20">
        <div>
            <p class="text-xs font-semibold tracking-[0.25em] text-[#8a6a4a] uppercase">Get in touch</p>
            <h2 class="mt-3 font-serif text-3xl text-[#29231e]">We would love to hear from you.</h2>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <a href="mailto:hello@curtainskenya.com" class="rounded-xl border border-[#e7dfd5] p-5 transition hover:border-[#8a6a4a] hover:bg-[#faf8f5]"><p class="text-xs font-semibold tracking-[0.18em] text-[#8a6a4a] uppercase">Email</p><p class="mt-3 text-sm font-medium text-[#29231e]">hello@curtainskenya.com</p></a>
                <a href="tel:+254720373737" class="rounded-xl border border-[#e7dfd5] p-5 transition hover:border-[#8a6a4a] hover:bg-[#faf8f5]"><p class="text-xs font-semibold tracking-[0.18em] text-[#8a6a4a] uppercase">Call us</p><p class="mt-3 text-sm font-medium text-[#29231e]">+254 720 373 737</p></a>
            </div>

            <a href="https://wa.me/254720373737" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex items-center bg-[#29231e] px-6 py-3.5 text-xs font-semibold tracking-[0.16em] text-white uppercase transition hover:bg-[#463b33]">Chat on WhatsApp <span class="ml-4">↗</span></a>

            <div class="mt-12 border-t border-[#e7dfd5] pt-10">
                <p class="text-xs font-semibold tracking-[0.25em] text-[#8a6a4a] uppercase">Send an enquiry</p>
                <h2 class="mt-3 font-serif text-3xl text-[#29231e]">Tell us how we can help.</h2>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                    <div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800"><?php echo e(session('status')); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <form method="POST" action="<?php echo e(route('contact.store')); ?>" class="mt-7 grid gap-5 sm:grid-cols-2">
                    <?php echo csrf_field(); ?>
                    <div><label for="name" class="text-sm font-medium text-[#29231e]">Name</label><input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>" required autocomplete="name" class="mt-2 block w-full rounded-lg border-[#d8cfc4] bg-white text-[#29231e] shadow-sm focus:border-[#8a6a4a] focus:ring-[#8a6a4a]"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                    <div><label for="email" class="text-sm font-medium text-[#29231e]">Email address</label><input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" class="mt-2 block w-full rounded-lg border-[#d8cfc4] bg-white text-[#29231e] shadow-sm focus:border-[#8a6a4a] focus:ring-[#8a6a4a]"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                    <div><label for="phone" class="text-sm font-medium text-[#29231e]">Phone number <span class="font-normal text-[#8b7d70]">(optional)</span></label><input id="phone" name="phone" type="tel" value="<?php echo e(old('phone')); ?>" autocomplete="tel" class="mt-2 block w-full rounded-lg border-[#d8cfc4] bg-white text-[#29231e] shadow-sm focus:border-[#8a6a4a] focus:ring-[#8a6a4a]"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                    <div><label for="subject" class="text-sm font-medium text-[#29231e]">Subject</label><input id="subject" name="subject" type="text" value="<?php echo e(old('subject')); ?>" required class="mt-2 block w-full rounded-lg border-[#d8cfc4] bg-white text-[#29231e] shadow-sm focus:border-[#8a6a4a] focus:ring-[#8a6a4a]"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                    <div class="sm:col-span-2"><label for="message" class="text-sm font-medium text-[#29231e]">How can we help?</label><textarea id="message" name="message" rows="6" required class="mt-2 block w-full rounded-lg border-[#d8cfc4] bg-white text-[#29231e] shadow-sm focus:border-[#8a6a4a] focus:ring-[#8a6a4a]"><?php echo e(old('message')); ?></textarea><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                    <div class="sm:col-span-2"><button type="submit" class="inline-flex bg-[#29231e] px-6 py-3.5 text-xs font-semibold tracking-[0.16em] text-white uppercase transition hover:bg-[#463b33]">Send enquiry <span class="ml-4">→</span></button></div>
                </form>
            </div>
        </div>

        <aside class="rounded-xl bg-[#29231e] p-6 text-white sm:p-8">
            <p class="text-xs font-semibold tracking-[0.25em] text-[#cbb49b] uppercase">Social spaces</p>
            <h2 class="mt-3 font-serif text-3xl">Follow our story.</h2>
            <p class="mt-4 text-sm leading-7 text-white/70">Our social pages are being prepared. We will share new collections, fabric inspiration, and styling ideas there soon.</p>
            <div class="mt-7 grid gap-3">
                <div class="flex items-center justify-between border-b border-white/15 py-3 text-sm"><span>Facebook</span><span class="text-xs tracking-[0.14em] text-white/55 uppercase">Coming soon</span></div>
                <div class="flex items-center justify-between border-b border-white/15 py-3 text-sm"><span>Instagram</span><span class="text-xs tracking-[0.14em] text-white/55 uppercase">Coming soon</span></div>
                <div class="flex items-center justify-between border-b border-white/15 py-3 text-sm"><span>TikTok</span><span class="text-xs tracking-[0.14em] text-white/55 uppercase">Coming soon</span></div>
                <a href="https://wa.me/254720373737" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between py-3 text-sm transition hover:text-[#cbb49b]"><span>WhatsApp</span><span>↗</span></a>
            </div>
        </aside>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\resources\views/contact.blade.php ENDPATH**/ ?>