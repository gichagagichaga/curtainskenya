<?php
if (!function_exists('_de7aae5be0ba9f2e2171db5d23daa515')):
function _de7aae5be0ba9f2e2171db5d23daa515($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
extract(Flux::forwardedAttributes($attributes, [
    'tooltipPosition',
    'tooltipKbd',
    'tooltip',
]));
?>

<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
unset($__defaults);
?>

<?php if ($tooltip): ?>
    <?php if (!function_exists('_7a239eb85587bf3da651392011cee203')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/7a239eb85587bf3da651392011cee203.php'); require $__blaze->compiledPath.'/7a239eb85587bf3da651392011cee203.php'; } ?>
<?php if (isset($__slots7a239eb85587bf3da651392011cee203)) { $__slotsStack7a239eb85587bf3da651392011cee203[] = $__slots7a239eb85587bf3da651392011cee203; } ?>
<?php if (isset($__attrs7a239eb85587bf3da651392011cee203)) { $__attrsStack7a239eb85587bf3da651392011cee203[] = $__attrs7a239eb85587bf3da651392011cee203; } ?>
<?php $__attrs7a239eb85587bf3da651392011cee203 = ['class' => 'inline-flex','content' => $tooltip,'position' => $tooltipPosition,'kbd' => $tooltipKbd]; ?>
<?php $__slots7a239eb85587bf3da651392011cee203 = []; ?>
<?php $__blaze->pushData($__attrs7a239eb85587bf3da651392011cee203); ?>
<?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php $__slots7a239eb85587bf3da651392011cee203['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots7a239eb85587bf3da651392011cee203); ?>
<?php _7a239eb85587bf3da651392011cee203($__blaze, $__attrs7a239eb85587bf3da651392011cee203, $__slots7a239eb85587bf3da651392011cee203, ['content', 'position', 'kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack7a239eb85587bf3da651392011cee203)) { $__slots7a239eb85587bf3da651392011cee203 = array_pop($__slotsStack7a239eb85587bf3da651392011cee203); } ?>
<?php if (! empty($__attrsStack7a239eb85587bf3da651392011cee203)) { $__attrs7a239eb85587bf3da651392011cee203 = array_pop($__attrsStack7a239eb85587bf3da651392011cee203); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/with-tooltip.blade.php ENDPATH**/ ?>