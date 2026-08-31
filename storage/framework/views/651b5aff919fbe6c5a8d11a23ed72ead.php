<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'sidebar' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'sidebar' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sidebar): ?>
    <?php if (!function_exists('_46f2803b502d9ba73c98a379be2f19b9')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/brand.blade.php', $__blaze->compiledPath.'/46f2803b502d9ba73c98a379be2f19b9.php'); require $__blaze->compiledPath.'/46f2803b502d9ba73c98a379be2f19b9.php'; } ?>
<?php if (isset($__slots46f2803b502d9ba73c98a379be2f19b9)) { $__slotsStack46f2803b502d9ba73c98a379be2f19b9[] = $__slots46f2803b502d9ba73c98a379be2f19b9; } ?>
<?php if (isset($__attrs46f2803b502d9ba73c98a379be2f19b9)) { $__attrsStack46f2803b502d9ba73c98a379be2f19b9[] = $__attrs46f2803b502d9ba73c98a379be2f19b9; } ?>
<?php $__attrs46f2803b502d9ba73c98a379be2f19b9 = ['name' => config('app.name', 'Laravel'),'attributes' => $attributes]; ?>
<?php $__slots46f2803b502d9ba73c98a379be2f19b9 = []; ?>
<?php $__blaze->pushData($__attrs46f2803b502d9ba73c98a379be2f19b9); ?>
<?php ob_start(); ?>
         <?php ob_start(); ?>
            <img src="<?php echo e(asset('images/curtains-kenya-logo.png')); ?>" alt="Curtains Kenya" class="h-full w-full object-contain">
        <?php $__slots46f2803b502d9ba73c98a379be2f19b9['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex size-9 items-center justify-center overflow-hidden rounded-md bg-white']); ?>
    <?php $__slots46f2803b502d9ba73c98a379be2f19b9['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots46f2803b502d9ba73c98a379be2f19b9); ?>
<?php _46f2803b502d9ba73c98a379be2f19b9($__blaze, $__attrs46f2803b502d9ba73c98a379be2f19b9, $__slots46f2803b502d9ba73c98a379be2f19b9, ['name', 'attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack46f2803b502d9ba73c98a379be2f19b9)) { $__slots46f2803b502d9ba73c98a379be2f19b9 = array_pop($__slotsStack46f2803b502d9ba73c98a379be2f19b9); } ?>
<?php if (! empty($__attrsStack46f2803b502d9ba73c98a379be2f19b9)) { $__attrs46f2803b502d9ba73c98a379be2f19b9 = array_pop($__attrsStack46f2803b502d9ba73c98a379be2f19b9); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php if (!function_exists('_012a6e64548739ba04aadc8d700112b6')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/brand.blade.php', $__blaze->compiledPath.'/012a6e64548739ba04aadc8d700112b6.php'); require $__blaze->compiledPath.'/012a6e64548739ba04aadc8d700112b6.php'; } ?>
<?php if (isset($__slots012a6e64548739ba04aadc8d700112b6)) { $__slotsStack012a6e64548739ba04aadc8d700112b6[] = $__slots012a6e64548739ba04aadc8d700112b6; } ?>
<?php if (isset($__attrs012a6e64548739ba04aadc8d700112b6)) { $__attrsStack012a6e64548739ba04aadc8d700112b6[] = $__attrs012a6e64548739ba04aadc8d700112b6; } ?>
<?php $__attrs012a6e64548739ba04aadc8d700112b6 = ['name' => config('app.name', 'Laravel'),'attributes' => $attributes]; ?>
<?php $__slots012a6e64548739ba04aadc8d700112b6 = []; ?>
<?php $__blaze->pushData($__attrs012a6e64548739ba04aadc8d700112b6); ?>
<?php ob_start(); ?>
         <?php ob_start(); ?>
            <img src="<?php echo e(asset('images/curtains-kenya-logo.png')); ?>" alt="Curtains Kenya" class="h-full w-full object-contain">
        <?php $__slots012a6e64548739ba04aadc8d700112b6['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex size-9 items-center justify-center overflow-hidden rounded-md bg-white']); ?>
    <?php $__slots012a6e64548739ba04aadc8d700112b6['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots012a6e64548739ba04aadc8d700112b6); ?>
<?php _012a6e64548739ba04aadc8d700112b6($__blaze, $__attrs012a6e64548739ba04aadc8d700112b6, $__slots012a6e64548739ba04aadc8d700112b6, ['name', 'attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack012a6e64548739ba04aadc8d700112b6)) { $__slots012a6e64548739ba04aadc8d700112b6 = array_pop($__slotsStack012a6e64548739ba04aadc8d700112b6); } ?>
<?php if (! empty($__attrsStack012a6e64548739ba04aadc8d700112b6)) { $__attrs012a6e64548739ba04aadc8d700112b6 = array_pop($__attrsStack012a6e64548739ba04aadc8d700112b6); } ?>
<?php $__blaze->popData(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH C:\Users\NTATU\Herd\curtainskenya\resources\views/components/app-logo.blade.php ENDPATH**/ ?>