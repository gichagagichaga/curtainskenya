<?php
if (!function_exists('_325be294be6407ad2865195d16c0facf')):
function _325be294be6407ad2865195d16c0facf($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>
<?php $iconTrailing ??= $attributes->pluck('icon:trailing'); ?>
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'right',
    'tooltipKbd' => null,
    'tooltip' => null,
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'iconDot' => null,
    'accent' => true,
    'badge' => null,
    'icon' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$badgeColor ??= $attributes['badge-color'] ?? $attributes['badgeColor'] ?? $__defaults['badgeColor']; unset($attributes['badgeColor'], $attributes['badge-color']);
$iconDot ??= $attributes['icon-dot'] ?? $attributes['iconDot'] ?? $__defaults['iconDot']; unset($attributes['iconDot'], $attributes['icon-dot']);
$accent ??= $attributes['accent'] ?? $__defaults['accent']; unset($attributes['accent']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
unset($__defaults);
?>

<?php
// Slots contain rendered HTML (including conditional comments) and encoded entities.
// Tooltips should mirror only the visible text.
$tooltip ??= $slot->isNotEmpty()
    ? trim(html_entity_decode(strip_tags((string) $slot), ENT_QUOTES | ENT_HTML5, 'UTF-8'))
    : null;

// Size-up icons in square/icon-only buttons...
$iconClasses = Flux::classes('size-4')
    ->add('in-data-flux-sidebar-group-dropdown:text-zinc-400! dark:in-data-flux-sidebar-group-dropdown:text-white/80!')
    ->add('[[data-flux-sidebar-item]:hover_&]:text-current!')
    ->add('[[data-flux-sidebar-item][data-active]_&]:text-current!');

$classes = Flux::classes()
    ->add('h-8 in-data-flux-sidebar-on-mobile:h-10 relative flex items-center gap-3 rounded-lg')
    ->add('in-data-flux-sidebar-collapsed-desktop:w-10 in-data-flux-sidebar-collapsed-desktop:justify-center')
    ->add('py-0 text-start w-full px-3 has-data-flux-navlist-badge:not-in-data-flux-sidebar-collapsed-desktop:pe-1.5 my-px')
    ->add('text-zinc-500 dark:text-white/80')
    ->add(match ($accent) {
        true => [
            'data-current:text-(--color-accent-content) hover:data-current:text-(--color-accent-content)',
            'data-current:bg-white dark:data-current:bg-white/[7%] data-current:border data-current:border-zinc-200 dark:data-current:border-transparent',
            'hover:text-zinc-800 dark:hover:text-white dark:hover:bg-white/[7%] hover:bg-zinc-800/5 ',
            'border border-transparent',
        ],
        false => [
            'data-current:text-zinc-800 dark:data-current:text-zinc-100 data-current:border-zinc-200',
            'data-current:bg-white dark:data-current:bg-white/10 data-current:border data-current:border-zinc-200 dark:data-current:border-white/10 data-current:shadow-xs',
            'hover:text-zinc-800 dark:hover:text-white',
        ],
    })
    // Override the default styles to match dropdowns for when the item is inside a collapsed group dropdown...
    ->add('in-data-flux-sidebar-group-dropdown:w-auto! in-data-flux-sidebar-group-dropdown:px-2!')
    ->add('in-data-flux-sidebar-group-dropdown:focus:outline-hidden!')
    ->add('in-data-flux-sidebar-group-dropdown:text-zinc-800! in-data-flux-sidebar-group-dropdown:bg-white! in-data-flux-sidebar-group-dropdown:hover:bg-zinc-50!')
    ->add('in-data-flux-sidebar-group-dropdown:data-active:bg-zinc-50!')
    ->add('dark:in-data-flux-sidebar-group-dropdown:text-white! dark:in-data-flux-sidebar-group-dropdown:bg-transparent! dark:in-data-flux-sidebar-group-dropdown:hover:bg-zinc-600! dark:in-data-flux-sidebar-group-dropdown:data-active:bg-zinc-600!')
    ;
?>

<?php if (!function_exists('_7a239eb85587bf3da651392011cee203')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/7a239eb85587bf3da651392011cee203.php'); require $__blaze->compiledPath.'/7a239eb85587bf3da651392011cee203.php'; } ?>
<?php if (isset($__slots7a239eb85587bf3da651392011cee203)) { $__slotsStack7a239eb85587bf3da651392011cee203[] = $__slots7a239eb85587bf3da651392011cee203; } ?>
<?php if (isset($__attrs7a239eb85587bf3da651392011cee203)) { $__attrsStack7a239eb85587bf3da651392011cee203[] = $__attrs7a239eb85587bf3da651392011cee203; } ?>
<?php $__attrs7a239eb85587bf3da651392011cee203 = ['position' => $tooltipPosition]; ?>
<?php $__slots7a239eb85587bf3da651392011cee203 = []; ?>
<?php $__blaze->pushData($__attrs7a239eb85587bf3da651392011cee203); ?>
<?php ob_start(); ?>
    <?php if (!function_exists('_d5d8e98fb4f3c28e4b720d80343172ff')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/button-or-link.blade.php', $__blaze->compiledPath.'/d5d8e98fb4f3c28e4b720d80343172ff.php'); require $__blaze->compiledPath.'/d5d8e98fb4f3c28e4b720d80343172ff.php'; } ?>
<?php if (isset($__slotsd5d8e98fb4f3c28e4b720d80343172ff)) { $__slotsStackd5d8e98fb4f3c28e4b720d80343172ff[] = $__slotsd5d8e98fb4f3c28e4b720d80343172ff; } ?>
<?php if (isset($__attrsd5d8e98fb4f3c28e4b720d80343172ff)) { $__attrsStackd5d8e98fb4f3c28e4b720d80343172ff[] = $__attrsd5d8e98fb4f3c28e4b720d80343172ff; } ?>
<?php $__attrsd5d8e98fb4f3c28e4b720d80343172ff = ['attributes' => $attributes->class($classes),'dataFluxSidebarItem' => true]; ?>
<?php $__slotsd5d8e98fb4f3c28e4b720d80343172ff = []; ?>
<?php $__blaze->pushData($__attrsd5d8e98fb4f3c28e4b720d80343172ff); ?>
<?php ob_start(); ?>
        <?php if ($icon): ?>
            <div class="relative">
                <?php if (is_string($icon) && $icon !== ''): ?>
                    <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $icon, 'variant' => $iconVariant, 'class' => $iconClasses]); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php if (!function_exists('_34af3e88ce3ae520ec9e8c7d3a539fe7')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/34af3e88ce3ae520ec9e8c7d3a539fe7.php'); require $__blaze->compiledPath.'/34af3e88ce3ae520ec9e8c7d3a539fe7.php'; } ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses]); ?>
<?php _34af3e88ce3ae520ec9e8c7d3a539fe7($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
                <?php else: ?>
                    <?php echo e($icon); ?>

                <?php endif; ?>

                <?php if ($iconDot): ?>
                    <div class="absolute top-[-2px] end-[-2px]">
                        <div class="size-[6px] rounded-full bg-zinc-500 dark:bg-zinc-400"></div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($slot->isNotEmpty()): ?>
            <div class="
                in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden
                flex-1 text-sm font-medium truncate [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block" data-content><?php echo e($slot); ?></div>
        <?php endif; ?>

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            <?php $blaze_memoized_key = \Livewire\Blaze\Memoizer\Memo::key("flux::icon", ['icon' => $iconTrailing, 'variant' => $iconVariant, 'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!']); ?><?php if ($blaze_memoized_key !== null && \Livewire\Blaze\Memoizer\Memo::has($blaze_memoized_key)) : ?><?php echo \Livewire\Blaze\Memoizer\Memo::get($blaze_memoized_key); ?><?php else : ?><?php ob_start(); ?><?php if (!function_exists('_34af3e88ce3ae520ec9e8c7d3a539fe7')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/34af3e88ce3ae520ec9e8c7d3a539fe7.php'); require $__blaze->compiledPath.'/34af3e88ce3ae520ec9e8c7d3a539fe7.php'; } ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!']); ?>
<?php _34af3e88ce3ae520ec9e8c7d3a539fe7($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden size-4!'], [], ['icon', 'variant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?><?php $blaze_memoized_html = ob_get_clean(); ?><?php if ($blaze_memoized_key !== null) { \Livewire\Blaze\Memoizer\Memo::put($blaze_memoized_key, $blaze_memoized_html); } ?><?php echo $blaze_memoized_html; ?><?php endif; ?>
        <?php elseif ($iconTrailing): ?>
            <?php echo e($iconTrailing); ?>

        <?php endif; ?>

        <?php if (isset($badge) && $badge !== ''): ?>
            <?php $badgeAttributes = Flux::attributesAfter('badge:', $attributes, ['color' => $badgeColor]); ?>
            <?php if (!function_exists('_ee58f38fee7f2e585fd1b5ae933bf1df')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/navlist/badge.blade.php', $__blaze->compiledPath.'/ee58f38fee7f2e585fd1b5ae933bf1df.php'); require $__blaze->compiledPath.'/ee58f38fee7f2e585fd1b5ae933bf1df.php'; } ?>
<?php if (isset($__slotsee58f38fee7f2e585fd1b5ae933bf1df)) { $__slotsStackee58f38fee7f2e585fd1b5ae933bf1df[] = $__slotsee58f38fee7f2e585fd1b5ae933bf1df; } ?>
<?php if (isset($__attrsee58f38fee7f2e585fd1b5ae933bf1df)) { $__attrsStackee58f38fee7f2e585fd1b5ae933bf1df[] = $__attrsee58f38fee7f2e585fd1b5ae933bf1df; } ?>
<?php $__attrsee58f38fee7f2e585fd1b5ae933bf1df = ['attributes' => $badgeAttributes,'class' => 'in-data-flux-sidebar-collapsed-desktop:not-in-data-flux-sidebar-group-dropdown:hidden']; ?>
<?php $__slotsee58f38fee7f2e585fd1b5ae933bf1df = []; ?>
<?php $__blaze->pushData($__attrsee58f38fee7f2e585fd1b5ae933bf1df); ?>
<?php ob_start(); ?><?php echo e($badge); ?><?php $__slotsee58f38fee7f2e585fd1b5ae933bf1df['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsee58f38fee7f2e585fd1b5ae933bf1df); ?>
<?php _ee58f38fee7f2e585fd1b5ae933bf1df($__blaze, $__attrsee58f38fee7f2e585fd1b5ae933bf1df, $__slotsee58f38fee7f2e585fd1b5ae933bf1df, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackee58f38fee7f2e585fd1b5ae933bf1df)) { $__slotsee58f38fee7f2e585fd1b5ae933bf1df = array_pop($__slotsStackee58f38fee7f2e585fd1b5ae933bf1df); } ?>
<?php if (! empty($__attrsStackee58f38fee7f2e585fd1b5ae933bf1df)) { $__attrsee58f38fee7f2e585fd1b5ae933bf1df = array_pop($__attrsStackee58f38fee7f2e585fd1b5ae933bf1df); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slotsd5d8e98fb4f3c28e4b720d80343172ff['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsd5d8e98fb4f3c28e4b720d80343172ff); ?>
<?php _d5d8e98fb4f3c28e4b720d80343172ff($__blaze, $__attrsd5d8e98fb4f3c28e4b720d80343172ff, $__slotsd5d8e98fb4f3c28e4b720d80343172ff, ['attributes', 'dataFluxSidebarItem'], ['dataFluxSidebarItem' => 'data-flux-sidebar-item'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackd5d8e98fb4f3c28e4b720d80343172ff)) { $__slotsd5d8e98fb4f3c28e4b720d80343172ff = array_pop($__slotsStackd5d8e98fb4f3c28e4b720d80343172ff); } ?>
<?php if (! empty($__attrsStackd5d8e98fb4f3c28e4b720d80343172ff)) { $__attrsd5d8e98fb4f3c28e4b720d80343172ff = array_pop($__attrsStackd5d8e98fb4f3c28e4b720d80343172ff); } ?>
<?php $__blaze->popData(); ?>

    <?php if (!function_exists('_06dd8554accedfaa136bc13440fdeb62')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/06dd8554accedfaa136bc13440fdeb62.php'); require $__blaze->compiledPath.'/06dd8554accedfaa136bc13440fdeb62.php'; } ?>
<?php if (isset($__slots06dd8554accedfaa136bc13440fdeb62)) { $__slotsStack06dd8554accedfaa136bc13440fdeb62[] = $__slots06dd8554accedfaa136bc13440fdeb62; } ?>
<?php if (isset($__attrs06dd8554accedfaa136bc13440fdeb62)) { $__attrsStack06dd8554accedfaa136bc13440fdeb62[] = $__attrs06dd8554accedfaa136bc13440fdeb62; } ?>
<?php $__attrs06dd8554accedfaa136bc13440fdeb62 = ['kbd' => $tooltipKbd,'class' => 'not-in-data-flux-sidebar-collapsed-desktop:hidden in-data-flux-sidebar-group-dropdown:hidden cursor-default']; ?>
<?php $__slots06dd8554accedfaa136bc13440fdeb62 = []; ?>
<?php $__blaze->pushData($__attrs06dd8554accedfaa136bc13440fdeb62); ?>
<?php ob_start(); ?>
        <?php echo e($tooltip); ?>

    <?php $__slots06dd8554accedfaa136bc13440fdeb62['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots06dd8554accedfaa136bc13440fdeb62); ?>
<?php _06dd8554accedfaa136bc13440fdeb62($__blaze, $__attrs06dd8554accedfaa136bc13440fdeb62, $__slots06dd8554accedfaa136bc13440fdeb62, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack06dd8554accedfaa136bc13440fdeb62)) { $__slots06dd8554accedfaa136bc13440fdeb62 = array_pop($__slotsStack06dd8554accedfaa136bc13440fdeb62); } ?>
<?php if (! empty($__attrsStack06dd8554accedfaa136bc13440fdeb62)) { $__attrs06dd8554accedfaa136bc13440fdeb62 = array_pop($__attrsStack06dd8554accedfaa136bc13440fdeb62); } ?>
<?php $__blaze->popData(); ?>
<?php $__slots7a239eb85587bf3da651392011cee203['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots7a239eb85587bf3da651392011cee203); ?>
<?php _7a239eb85587bf3da651392011cee203($__blaze, $__attrs7a239eb85587bf3da651392011cee203, $__slots7a239eb85587bf3da651392011cee203, ['position'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack7a239eb85587bf3da651392011cee203)) { $__slots7a239eb85587bf3da651392011cee203 = array_pop($__slotsStack7a239eb85587bf3da651392011cee203); } ?>
<?php if (! empty($__attrsStack7a239eb85587bf3da651392011cee203)) { $__attrs7a239eb85587bf3da651392011cee203 = array_pop($__attrsStack7a239eb85587bf3da651392011cee203); } ?>
<?php $__blaze->popData(); ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/sidebar/item.blade.php ENDPATH**/ ?>