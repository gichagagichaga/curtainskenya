<?php
if (!function_exists('_5098115a6a20ff4194b305a5a43db5bc')):
function _5098115a6a20ff4194b305a5a43db5bc($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
$__defaults = [
    'iconVariant' => 'mini',
    'size' => null,
];
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$size ??= $attributes['size'] ?? $__defaults['size']; unset($attributes['size']);
unset($__defaults);
?>

<?php
$attributes = $attributes->merge([
    'variant' => 'subtle',
    'class' => '-me-1',
    'square' => true,
    'size' => null,
]);
?>

<?php if (!function_exists('_5b2925844268dd9575f12cdbdf1dffdb')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/button/index.blade.php', $__blaze->compiledPath.'/5b2925844268dd9575f12cdbdf1dffdb.php'); require $__blaze->compiledPath.'/5b2925844268dd9575f12cdbdf1dffdb.php'; } ?>
<?php if (isset($__slots5b2925844268dd9575f12cdbdf1dffdb)) { $__slotsStack5b2925844268dd9575f12cdbdf1dffdb[] = $__slots5b2925844268dd9575f12cdbdf1dffdb; } ?>
<?php if (isset($__attrs5b2925844268dd9575f12cdbdf1dffdb)) { $__attrsStack5b2925844268dd9575f12cdbdf1dffdb[] = $__attrs5b2925844268dd9575f12cdbdf1dffdb; } ?>
<?php $__attrs5b2925844268dd9575f12cdbdf1dffdb = ['attributes' => $attributes,'size' => $size === 'sm' || $size === 'xs' ? 'xs' : 'sm','xData' => 'fluxInputViewable','xOn:click' => 'toggle()','xBind:dataViewableOpen' => 'open','ariaLabel' => e(__('Toggle password visibility'))]; ?>
<?php $__slots5b2925844268dd9575f12cdbdf1dffdb = []; ?>
<?php $__blaze->pushData($__attrs5b2925844268dd9575f12cdbdf1dffdb); ?>
<?php ob_start(); ?>
    <?php if (!function_exists('_994e512df63e3b4168898020455e01fb')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/eye-slash.blade.php', $__blaze->compiledPath.'/994e512df63e3b4168898020455e01fb.php'); require $__blaze->compiledPath.'/994e512df63e3b4168898020455e01fb.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'hidden [[data-viewable-open]>&]:block']); ?>
<?php _994e512df63e3b4168898020455e01fb($__blaze, ['variant' => $iconVariant,'class' => 'hidden [[data-viewable-open]>&]:block'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
    <?php if (!function_exists('_437780ec3c8d00c93505bb1b4fea1849')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/eye.blade.php', $__blaze->compiledPath.'/437780ec3c8d00c93505bb1b4fea1849.php'); require $__blaze->compiledPath.'/437780ec3c8d00c93505bb1b4fea1849.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'block [[data-viewable-open]>&]:hidden']); ?>
<?php _437780ec3c8d00c93505bb1b4fea1849($__blaze, ['variant' => $iconVariant,'class' => 'block [[data-viewable-open]>&]:hidden'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
<?php $__slots5b2925844268dd9575f12cdbdf1dffdb['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots5b2925844268dd9575f12cdbdf1dffdb); ?>
<?php _5b2925844268dd9575f12cdbdf1dffdb($__blaze, $__attrs5b2925844268dd9575f12cdbdf1dffdb, $__slots5b2925844268dd9575f12cdbdf1dffdb, ['attributes', 'size'], ['xData' => 'x-data', 'xOn:click' => 'x-on:click', 'xBind:dataViewableOpen' => 'x-bind:data-viewable-open', 'ariaLabel' => 'aria-label'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack5b2925844268dd9575f12cdbdf1dffdb)) { $__slots5b2925844268dd9575f12cdbdf1dffdb = array_pop($__slotsStack5b2925844268dd9575f12cdbdf1dffdb); } ?>
<?php if (! empty($__attrsStack5b2925844268dd9575f12cdbdf1dffdb)) { $__attrs5b2925844268dd9575f12cdbdf1dffdb = array_pop($__attrsStack5b2925844268dd9575f12cdbdf1dffdb); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/input/viewable.blade.php ENDPATH**/ ?>