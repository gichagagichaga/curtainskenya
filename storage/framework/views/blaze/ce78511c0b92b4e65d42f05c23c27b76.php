<?php
if (!function_exists('__ce78511c0b92b4e65d42f05c23c27b76')):
function __ce78511c0b92b4e65d42f05c23c27b76($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<div class="-mx-[.3125rem] my-[.3125rem] h-px" <?php echo e($attributes); ?> data-flux-menu-separator>
    <?php if (!function_exists('__68b0e026ee17876703baf7aa67a6b2eb')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/separator.blade.php', $__blaze->compiledPath.'/68b0e026ee17876703baf7aa67a6b2eb.php'); require $__blaze->compiledPath.'/68b0e026ee17876703baf7aa67a6b2eb.php'; } ?>
<?php $__blaze->pushData(['class' => 'dark:bg-zinc-600!']); ?>
<?php __68b0e026ee17876703baf7aa67a6b2eb($__blaze, ['class' => 'dark:bg-zinc-600!'], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
</div>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/separator.blade.php ENDPATH**/ ?>