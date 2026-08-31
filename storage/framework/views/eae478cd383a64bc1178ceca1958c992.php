<?php if (isset($component)) { $__componentOriginal81a506f898233b9e7d58286e6bea3c18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81a506f898233b9e7d58286e6bea3c18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'f4ac99e09542ff494432bc959d4fee61::app','data' => ['title' => __('Dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts::app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Dashboard'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
        <div class="border-b border-zinc-200 pb-6 dark:border-zinc-700">
            <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Curtains Kenya administration</p>
            <h1 class="mt-1 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Dashboard</h1>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">A quick overview of your catalogue.</p>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="<?php echo e(route('admin.products.index')); ?>" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Products</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white"><?php echo e($productCount); ?></p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400"><?php echo e($activeProductCount); ?> active in the shop</p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Categories</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white"><?php echo e($categoryCount); ?></p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400"><?php echo e($activeCategoryCount); ?> visible in the shop</p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
            <a href="<?php echo e(route('admin.blog.posts.index')); ?>" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Blog</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white"><?php echo e($publishedPostCount); ?></p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400"><?php echo e($draftPostCount); ?> <?php echo e($draftPostCount === 1 ? 'draft article' : 'draft articles'); ?></p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
            <a href="<?php echo e(route('admin.enquiries.index')); ?>" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Customer enquiries</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white"><?php echo e($newEnquiryCount); ?></p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400"><?php echo e($newEnquiryCount === 1 ? 'awaiting a response' : 'awaiting responses'); ?></p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="group rounded-xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-400 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-500">
                <div class="flex items-start justify-between gap-4"><div><p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">New orders</p><p class="mt-3 text-4xl font-semibold tracking-tight text-zinc-900 dark:text-white"><?php echo e($pendingOrderCount); ?></p><p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400"><?php echo e($pendingOrderCount === 1 ? 'awaiting review' : 'awaiting review'); ?></p></div><span class="text-zinc-400 transition group-hover:translate-x-1 group-hover:text-zinc-900 dark:group-hover:text-white">→</span></div>
            </a>
        </div>

        <section class="mt-6 rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900 sm:p-6">
            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">Catalogue actions</h2>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Add products or organise the categories customers browse.</p>
            <div class="mt-5 flex flex-wrap gap-3"><a href="<?php echo e(route('admin.products.create')); ?>" class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-zinc-700 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">Add product</a><a href="<?php echo e(route('admin.categories.create')); ?>" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Add category</a></div>
            <div class="mt-3 flex flex-wrap gap-3"><a href="<?php echo e(route('admin.blog.posts.index')); ?>" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Manage blog</a><a href="<?php echo e(route('admin.blog.posts.create')); ?>" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Add article</a><a href="<?php echo e(route('admin.story.edit')); ?>" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">Edit our story</a><a href="<?php echo e(route('admin.enquiries.index')); ?>" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">View enquiries</a><a href="<?php echo e(route('admin.orders.index')); ?>" class="rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">View orders</a></div>
        </section>
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
<?php /**PATH C:\Users\NTATU\Herd\curtainskenya\resources\views/dashboard.blade.php ENDPATH**/ ?>