<?php
if (!function_exists('__61db79c7c72c4c05fcd3dfb2cda2e6e6')):
function __61db79c7c72c4c05fcd3dfb2cda2e6e6($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php if (!function_exists('__5b2925844268dd9575f12cdbdf1dffdb')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/5b2925844268dd9575f12cdbdf1dffdb.php'); require $__blaze->compiledPath.'/5b2925844268dd9575f12cdbdf1dffdb.php'; } ?>
<?php $__blaze->pushData(['attributes' => $attributes->class('shrink-0'),'variant' => 'subtle','square' => true,'xData' => true,'xOn:click' => '$dispatch(\'flux-sidebar-toggle\')','ariaLabel' => e(__('Toggle sidebar')),'dataFluxSidebarToggle' => true]); ?>
<?php __5b2925844268dd9575f12cdbdf1dffdb($__blaze, ['attributes' => $attributes->class('shrink-0'),'variant' => 'subtle','square' => true,'xData' => true,'xOn:click' => '$dispatch(\'flux-sidebar-toggle\')','ariaLabel' => e(__('Toggle sidebar')),'dataFluxSidebarToggle' => true], [], ['attributes', 'square', 'xData', 'dataFluxSidebarToggle'], ['xData' => 'x-data', 'xOn:click' => 'x-on:click', 'ariaLabel' => 'aria-label', 'dataFluxSidebarToggle' => 'data-flux-sidebar-toggle'], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/toggle.blade.php ENDPATH**/ ?>