<?php if (isset($component)) { $__componentOriginal81a506f898233b9e7d58286e6bea3c18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81a506f898233b9e7d58286e6bea3c18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'f4ac99e09542ff494432bc959d4fee61::app','data' => ['title' => __('Services')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts::app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Services'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
        <div class="flex items-center justify-between border-b border-zinc-200 pb-6 dark:border-zinc-700">
            <div><p class="text-sm text-zinc-500">Public website offerings</p><h1 class="mt-1 text-2xl font-semibold text-zinc-900 dark:text-white">Services</h1></div>
            <a href="<?php echo e(route('admin.services.create')); ?>" class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white dark:bg-white dark:text-zinc-900">Add service</a>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?><div class="mt-6 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-800"><?php echo e(session('status')); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div class="mt-6 overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
            <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <article class="flex flex-col gap-4 p-5 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex gap-4"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->images->first()): ?><img src="<?php echo e(asset('storage/'.$service->images->first()->image_path)); ?>" alt="" class="size-16 rounded-lg object-cover"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><div><div class="flex items-center gap-3"><h2 class="font-semibold text-zinc-900 dark:text-white"><?php echo e($service->name); ?></h2><span class="rounded-full px-2.5 py-1 text-xs <?php echo e($service->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-zinc-100 text-zinc-600'); ?>"><?php echo e($service->is_active ? 'Visible' : 'Hidden'); ?></span></div><p class="mt-2 max-w-2xl text-sm leading-6 text-zinc-600 dark:text-zinc-300"><?php echo e($service->short_description ?: Str::limit($service->description, 150)); ?></p><p class="mt-2 text-xs text-zinc-500"><?php echo e($service->images->count()); ?> <?php echo e(Str::plural('image', $service->images->count())); ?> · Display order: <?php echo e($service->sort_order); ?></p></div></div>
                        <div class="flex shrink-0 items-center gap-4"><a href="<?php echo e(route('services.show', $service)); ?>" target="_blank" class="text-sm font-medium text-ck-blue">View</a><a href="<?php echo e(route('admin.services.edit', $service)); ?>" class="text-sm font-medium text-zinc-900 dark:text-white">Edit</a><form method="POST" action="<?php echo e(route('admin.services.destroy', $service)); ?>" onsubmit="return confirm('Delete this service?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="text-sm font-medium text-red-600">Delete</button></form></div>
                    </article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="p-12 text-center text-zinc-500">No services yet. Add your first offering to show it in the public menu.</div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($services->hasPages()): ?><div class="mt-6"><?php echo e($services->links()); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal81a506f898233b9e7d58286e6bea3c18)): ?>
<?php $attributes = $__attributesOriginal81a506f898233b9e7d58286e6bea3c18; ?>
<?php unset($__attributesOriginal81a506f898233b9e7d58286e6bea3c18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81a506f898233b9e7d58286e6bea3c18)): ?>
<?php $component = $__componentOriginal81a506f898233b9e7d58286e6bea3c18; ?>
<?php unset($__componentOriginal81a506f898233b9e7d58286e6bea3c18); ?>
<?php endif; ?>
<?php /**PATH C:\Users\NTATU\Herd\curtainskenya\resources\views/admin/services/index.blade.php ENDPATH**/ ?>