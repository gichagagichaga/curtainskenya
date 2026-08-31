<?php # [BlazeFolded]:{flux::icon.chevron-down}:{C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/chevron-down.blade.php}:{1787573014} ?>
<?php # [BlazeFolded]:{flux::icon.chevron-right}:{C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/chevron-right.blade.php}:{1787573014} ?>
<?php # [BlazeFolded]:{flux::menu}:{C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/index.blade.php}:{1787573014} ?>
<?php # [BlazeFolded]:{flux::dropdown}:{C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/dropdown.blade.php}:{1787573014} ?>
<?php # [BlazeFolded]:{flux::icon.chevron-down}:{C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/chevron-down.blade.php}:{1787573014} ?>
<?php # [BlazeFolded]:{flux::icon.chevron-right}:{C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/chevron-right.blade.php}:{1787573014} ?>
<?php
if (!function_exists('_1eba38708b26d7c6f9ec1191dd78198a')):
function _1eba38708b26d7c6f9ec1191dd78198a($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $iconTrailing ??= $attributes->pluck('icon:trailing'); ?>
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php
$__defaults = [
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'expandable' => false,
    'expanded' => true,
    'heading' => null,
    'icon' => null,
];
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$expandable ??= $attributes['expandable'] ?? $__defaults['expandable']; unset($attributes['expandable']);
$expanded ??= $attributes['expanded'] ?? $__defaults['expanded']; unset($attributes['expanded']);
$heading ??= $attributes['heading'] ?? $__defaults['heading']; unset($attributes['heading']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
unset($__defaults);
?>

<?php if ($expandable && $heading): ?>
    <?php if ($icon): ?>
        <ui-disclosure <?php echo e($attributes->class('group/disclosure in-data-flux-sidebar-collapsed-desktop:hidden')); ?> <?php if($expanded === true): ?> open <?php endif; ?> data-flux-sidebar-group>
            <button type="button" class="border-1 border-transparent w-full h-8 in-data-flux-sidebar-on-mobile:h-10 flex items-center group/disclosure-button my-px rounded-lg hover:bg-zinc-800/5 dark:hover:bg-white/[7%] text-zinc-500 hover:text-zinc-800 dark:text-white/80 dark:hover:text-white">
                <div class="px-3">
                    <?php if (is_string($icon) && $icon !== ''): ?>
                        <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $icon, 'variant' => $iconVariant, 'class' => 'size-4']); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php if (!function_exists('_34af3e88ce3ae520ec9e8c7d3a539fe7')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/34af3e88ce3ae520ec9e8c7d3a539fe7.php'); require $__blaze->compiledPath.'/34af3e88ce3ae520ec9e8c7d3a539fe7.php'; } ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => 'size-4']); ?>
<?php _34af3e88ce3ae520ec9e8c7d3a539fe7($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => 'size-4'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
                    <?php else: ?>
                        <?php echo e($icon); ?>

                    <?php endif; ?>
                </div>

                <span class="flex-1 text-left rtl:text-right text-sm font-medium leading-none"><?php echo e($heading); ?></span>

                <div class="ps-3 pe-2.5">
                    <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-3! hidden group-data-open/disclosure-button:block" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                    <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-3! block group-data-open/disclosure-button:hidden rtl:rotate-180" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                </div>
            </button>

            <div class="relative hidden data-open:block ps-7" <?php if($expanded === true): ?> data-open <?php endif; ?>>
                <div class="absolute inset-y-[3px] w-px bg-zinc-200 dark:bg-white/30 start-0 ms-5"></div>

                <div class="flex flex-col">
                    <?php echo e($slot); ?>

                </div>
            </div>
        </ui-disclosure>

        <?php ob_start(); ?><ui-dropdown position="right start" hover="hover" class="in-data-flux-sidebar-on-mobile:hidden not-in-data-flux-sidebar-collapsed-desktop:hidden" data-flux-sidebar-group-dropdown="data-flux-sidebar-group-dropdown" data-flux-dropdown>
    <?php ob_start(); ?>
            <button type="button" class="border-1 border-transparent w-full px-3 in-data-flux-menu:px-2 h-8 flex gap-3 items-center group/disclosure-button my-px rounded-lg in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-menu:w-10 in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-menu:justify-center hover:bg-zinc-800/5 dark:hover:bg-white/[7%] in-data-flux-menu:hover:bg-zinc-50 dark:in-data-flux-menu:hover:bg-zinc-600 text-zinc-500 in-data-flux-menu:text-zinc-800 hover:text-zinc-800 dark:text-white/80 in-data-flux-menu:dark:text-white dark:hover:text-white">
                <?php if ($icon): ?>
                    <div class="relative">
                        <?php if (is_string($icon) && $icon !== ''): ?>
                            <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $icon, 'variant' => $iconVariant, 'class' => 'in-data-flux-menu:text-zinc-400 in-data-flux-menu:dark:text-white/80 in-data-flux-menu:[[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current size-4']); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php if (!function_exists('_34af3e88ce3ae520ec9e8c7d3a539fe7')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/34af3e88ce3ae520ec9e8c7d3a539fe7.php'); require $__blaze->compiledPath.'/34af3e88ce3ae520ec9e8c7d3a539fe7.php'; } ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => 'in-data-flux-menu:text-zinc-400 in-data-flux-menu:dark:text-white/80 in-data-flux-menu:[[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current size-4']); ?>
<?php _34af3e88ce3ae520ec9e8c7d3a539fe7($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => 'in-data-flux-menu:text-zinc-400 in-data-flux-menu:dark:text-white/80 in-data-flux-menu:[[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current size-4'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
                        <?php else: ?>
                            <?php echo e($icon); ?>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <span class="hidden in-data-flux-menu:block flex-1 text-start text-sm font-medium leading-none text-zinc-800 dark:text-white"><?php echo e($heading); ?></span>

                <div class="hidden in-data-flux-menu:block">
                    <?php if (!function_exists('_0d870132a38472232c7ff8438bba37fe')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/chevron-right.blade.php', $__blaze->compiledPath.'/0d870132a38472232c7ff8438bba37fe.php'); require $__blaze->compiledPath.'/0d870132a38472232c7ff8438bba37fe.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'ms-auto size-4 text-zinc-400 [[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current rtl:hidden']); ?>
<?php _0d870132a38472232c7ff8438bba37fe($__blaze, ['variant' => $iconVariant,'class' => 'ms-auto size-4 text-zinc-400 [[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current rtl:hidden'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php if (!function_exists('_9ed18e1bd33c05bbff10d5f392fe35bc')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/chevron-left.blade.php', $__blaze->compiledPath.'/9ed18e1bd33c05bbff10d5f392fe35bc.php'); require $__blaze->compiledPath.'/9ed18e1bd33c05bbff10d5f392fe35bc.php'; } ?>
<?php $__blaze->pushData(['variant' => $iconVariant,'class' => 'ms-auto size-4 text-zinc-400 [[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current hidden rtl:inline']); ?>
<?php _9ed18e1bd33c05bbff10d5f392fe35bc($__blaze, ['variant' => $iconVariant,'class' => 'ms-auto size-4 text-zinc-400 [[data-flux-sidebar-group-dropdown]>button:hover_&]:text-current hidden rtl:inline'], [], ['variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                </div>
            </button>

            <?php ob_start(); ?><ui-menu
    class="[:where(&amp;)]:min-w-48 p-[.3125rem] rounded-lg shadow-xs border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 focus:outline-hidden"
    popover="manual"
    data-flux-menu
>
    <?php ob_start(); ?>
                <?php if (!function_exists('_ac0632df9d28da4fb9ebd26ebe1260b7')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/menu/group.blade.php', $__blaze->compiledPath.'/ac0632df9d28da4fb9ebd26ebe1260b7.php'); require $__blaze->compiledPath.'/ac0632df9d28da4fb9ebd26ebe1260b7.php'; } ?>
<?php if (isset($__slotsac0632df9d28da4fb9ebd26ebe1260b7)) { $__slotsStackac0632df9d28da4fb9ebd26ebe1260b7[] = $__slotsac0632df9d28da4fb9ebd26ebe1260b7; } ?>
<?php if (isset($__attrsac0632df9d28da4fb9ebd26ebe1260b7)) { $__attrsStackac0632df9d28da4fb9ebd26ebe1260b7[] = $__attrsac0632df9d28da4fb9ebd26ebe1260b7; } ?>
<?php $__attrsac0632df9d28da4fb9ebd26ebe1260b7 = ['heading' => $heading]; ?>
<?php $__slotsac0632df9d28da4fb9ebd26ebe1260b7 = []; ?>
<?php $__blaze->pushData($__attrsac0632df9d28da4fb9ebd26ebe1260b7); ?>
<?php ob_start(); ?>
                    <?php echo e($slot); ?>

                <?php $__slotsac0632df9d28da4fb9ebd26ebe1260b7['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsac0632df9d28da4fb9ebd26ebe1260b7); ?>
<?php _ac0632df9d28da4fb9ebd26ebe1260b7($__blaze, $__attrsac0632df9d28da4fb9ebd26ebe1260b7, $__slotsac0632df9d28da4fb9ebd26ebe1260b7, ['heading'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackac0632df9d28da4fb9ebd26ebe1260b7)) { $__slotsac0632df9d28da4fb9ebd26ebe1260b7 = array_pop($__slotsStackac0632df9d28da4fb9ebd26ebe1260b7); } ?>
<?php if (! empty($__attrsStackac0632df9d28da4fb9ebd26ebe1260b7)) { $__attrsac0632df9d28da4fb9ebd26ebe1260b7 = array_pop($__attrsStackac0632df9d28da4fb9ebd26ebe1260b7); } ?>
<?php $__blaze->popData(); ?>
            <?php echo trim(ob_get_clean()); ?>

</ui-menu>
<?php echo ltrim(ob_get_clean()); ?>
        <?php echo trim(ob_get_clean()); ?>

</ui-dropdown>
<?php echo ltrim(ob_get_clean()); ?>
    <?php else: ?>
        <ui-disclosure <?php echo e($attributes->class('group/disclosure in-data-flux-sidebar-collapsed-desktop:hidden')); ?> <?php if($expanded === true): ?> open <?php endif; ?> data-flux-sidebar-group>
            <button type="button" class="border-1 border-transparent w-full h-8 in-data-flux-sidebar-on-mobile:h-10 flex items-center group/disclosure-button my-px rounded-lg hover:bg-zinc-800/5 dark:hover:bg-white/[7%] text-zinc-500 hover:text-zinc-800 dark:text-white/80 dark:hover:text-white">
                <div class="ps-3.5 pe-3.5">
                    <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-3! hidden group-data-open/disclosure-button:block" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                    <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-3! block group-data-open/disclosure-button:hidden rtl:rotate-180" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                </div>

                <span class="text-sm font-medium leading-none"><?php echo e($heading); ?></span>
            </button>

            <div class="relative hidden data-open:block ps-7" <?php if($expanded === true): ?> data-open <?php endif; ?>>
                <div class="absolute inset-y-[3px] w-px bg-zinc-200 dark:bg-white/30 start-0 ms-5"></div>

                <div class="flex flex-col">
                    <?php echo e($slot); ?>

                </div>
            </div>
        </ui-disclosure>
    <?php endif; ?>

<?php elseif ($heading): ?>
    <div <?php echo e($attributes->class('flex flex-col in-data-flux-sidebar-collapsed-desktop:hidden')); ?> data-flux-sidebar-group>
        <div class="px-3 py-2">
            <div class="text-sm text-zinc-400 font-medium leading-none"><?php echo e($heading); ?></div>
        </div>

        <div class="flex flex-col">
            <?php echo e($slot); ?>

        </div>
    </div>
<?php else: ?>
    <div <?php echo e($attributes->class('flex flex-col in-data-flux-sidebar-collapsed-desktop:hidden')); ?> data-flux-sidebar-group>
        <?php echo e($slot); ?>

    </div>
<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/group.blade.php ENDPATH**/ ?>