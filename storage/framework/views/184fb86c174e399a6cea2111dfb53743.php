<?php
if (!function_exists('_184fb86c174e399a6cea2111dfb53743')):
function _184fb86c174e399a6cea2111dfb53743($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'name',
    'descriptionTrailing',
    'description',
    'label',
    'badge',
]));
?>

<?php $descriptionTrailing = $descriptionTrailing ??= $attributes->pluck('description:trailing'); ?>

<?php
$__defaults = [
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'descriptionTrailing' => null,
    'description' => null,
    'label' => null,
    'badge' => null,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
$descriptionTrailing ??= $attributes['description-trailing'] ?? $attributes['descriptionTrailing'] ?? $__defaults['descriptionTrailing']; unset($attributes['descriptionTrailing'], $attributes['description-trailing']);
$description ??= $attributes['description'] ?? $__defaults['description']; unset($attributes['description']);
$label ??= $attributes['label'] ?? $__defaults['label']; unset($attributes['label']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
unset($__defaults);
?>

<?php if (isset($label) || isset($description) || isset($descriptionTrailing)): ?>
    <?php

        $fieldAttributes = Flux::attributesAfter('field:', $attributes, []);
        $labelAttributes = Flux::attributesAfter('label:', $attributes, ['badge' => $badge]);
        $descriptionAttributes = Flux::attributesAfter('description:', $attributes, []);
        $errorAttributes = Flux::attributesAfter('error:', $attributes, ['name' => $name]);
    ?>
    <?php if (!function_exists('_1d208f203a21420691a8e767761f07b8')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/field.blade.php', $__blaze->compiledPath.'/1d208f203a21420691a8e767761f07b8.php'); require $__blaze->compiledPath.'/1d208f203a21420691a8e767761f07b8.php'; } ?>
<?php if (isset($__slots1d208f203a21420691a8e767761f07b8)) { $__slotsStack1d208f203a21420691a8e767761f07b8[] = $__slots1d208f203a21420691a8e767761f07b8; } ?>
<?php if (isset($__attrs1d208f203a21420691a8e767761f07b8)) { $__attrsStack1d208f203a21420691a8e767761f07b8[] = $__attrs1d208f203a21420691a8e767761f07b8; } ?>
<?php $__attrs1d208f203a21420691a8e767761f07b8 = ['attributes' => $fieldAttributes]; ?>
<?php $__slots1d208f203a21420691a8e767761f07b8 = []; ?>
<?php $__blaze->pushData($__attrs1d208f203a21420691a8e767761f07b8); ?>
<?php ob_start(); ?>
        <?php if (isset($label)): ?>
            <?php if (!function_exists('_dc33c8ebff9b42444a951314268499fb')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/label.blade.php', $__blaze->compiledPath.'/dc33c8ebff9b42444a951314268499fb.php'); require $__blaze->compiledPath.'/dc33c8ebff9b42444a951314268499fb.php'; } ?>
<?php if (isset($__slotsdc33c8ebff9b42444a951314268499fb)) { $__slotsStackdc33c8ebff9b42444a951314268499fb[] = $__slotsdc33c8ebff9b42444a951314268499fb; } ?>
<?php if (isset($__attrsdc33c8ebff9b42444a951314268499fb)) { $__attrsStackdc33c8ebff9b42444a951314268499fb[] = $__attrsdc33c8ebff9b42444a951314268499fb; } ?>
<?php $__attrsdc33c8ebff9b42444a951314268499fb = ['attributes' => $labelAttributes]; ?>
<?php $__slotsdc33c8ebff9b42444a951314268499fb = []; ?>
<?php $__blaze->pushData($__attrsdc33c8ebff9b42444a951314268499fb); ?>
<?php ob_start(); ?><?php echo e($label); ?><?php $__slotsdc33c8ebff9b42444a951314268499fb['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsdc33c8ebff9b42444a951314268499fb); ?>
<?php _dc33c8ebff9b42444a951314268499fb($__blaze, $__attrsdc33c8ebff9b42444a951314268499fb, $__slotsdc33c8ebff9b42444a951314268499fb, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackdc33c8ebff9b42444a951314268499fb)) { $__slotsdc33c8ebff9b42444a951314268499fb = array_pop($__slotsStackdc33c8ebff9b42444a951314268499fb); } ?>
<?php if (! empty($__attrsStackdc33c8ebff9b42444a951314268499fb)) { $__attrsdc33c8ebff9b42444a951314268499fb = array_pop($__attrsStackdc33c8ebff9b42444a951314268499fb); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <?php if (!function_exists('_b37819c81aac29fb817c83348e8798a6')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/b37819c81aac29fb817c83348e8798a6.php'); require $__blaze->compiledPath.'/b37819c81aac29fb817c83348e8798a6.php'; } ?>
<?php if (isset($__slotsb37819c81aac29fb817c83348e8798a6)) { $__slotsStackb37819c81aac29fb817c83348e8798a6[] = $__slotsb37819c81aac29fb817c83348e8798a6; } ?>
<?php if (isset($__attrsb37819c81aac29fb817c83348e8798a6)) { $__attrsStackb37819c81aac29fb817c83348e8798a6[] = $__attrsb37819c81aac29fb817c83348e8798a6; } ?>
<?php $__attrsb37819c81aac29fb817c83348e8798a6 = ['attributes' => $descriptionAttributes]; ?>
<?php $__slotsb37819c81aac29fb817c83348e8798a6 = []; ?>
<?php $__blaze->pushData($__attrsb37819c81aac29fb817c83348e8798a6); ?>
<?php ob_start(); ?><?php echo e($description); ?><?php $__slotsb37819c81aac29fb817c83348e8798a6['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsb37819c81aac29fb817c83348e8798a6); ?>
<?php _b37819c81aac29fb817c83348e8798a6($__blaze, $__attrsb37819c81aac29fb817c83348e8798a6, $__slotsb37819c81aac29fb817c83348e8798a6, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb37819c81aac29fb817c83348e8798a6)) { $__slotsb37819c81aac29fb817c83348e8798a6 = array_pop($__slotsStackb37819c81aac29fb817c83348e8798a6); } ?>
<?php if (! empty($__attrsStackb37819c81aac29fb817c83348e8798a6)) { $__attrsb37819c81aac29fb817c83348e8798a6 = array_pop($__attrsStackb37819c81aac29fb817c83348e8798a6); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php echo e($slot); ?>


        
        <?php $__getScope = fn($scope = []) => $scope; ?><?php if (isset($scope)) $__scope = $scope; ?><?php $scope = $__getScope(scope: ['attributes' => $errorAttributes->getAttributes()]); ?>
        <?php if (!function_exists('_46454072e6d5675708c21469e8cc39fe')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/error.blade.php', $__blaze->compiledPath.'/46454072e6d5675708c21469e8cc39fe.php'); require $__blaze->compiledPath.'/46454072e6d5675708c21469e8cc39fe.php'; } ?>
<?php $__blaze->pushData(['attributes' => new \Illuminate\View\ComponentAttributeBag($scope['attributes'])]); ?>
<?php _46454072e6d5675708c21469e8cc39fe($__blaze, ['attributes' => new \Illuminate\View\ComponentAttributeBag($scope['attributes'])], [], ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
        <?php if (isset($__scope)) { $scope = $__scope; unset($__scope); } ?>

        <?php if (isset($descriptionTrailing)): ?>
            <?php if (!function_exists('_b37819c81aac29fb817c83348e8798a6')) { $__blaze->compile('C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/b37819c81aac29fb817c83348e8798a6.php'); require $__blaze->compiledPath.'/b37819c81aac29fb817c83348e8798a6.php'; } ?>
<?php if (isset($__slotsb37819c81aac29fb817c83348e8798a6)) { $__slotsStackb37819c81aac29fb817c83348e8798a6[] = $__slotsb37819c81aac29fb817c83348e8798a6; } ?>
<?php if (isset($__attrsb37819c81aac29fb817c83348e8798a6)) { $__attrsStackb37819c81aac29fb817c83348e8798a6[] = $__attrsb37819c81aac29fb817c83348e8798a6; } ?>
<?php $__attrsb37819c81aac29fb817c83348e8798a6 = ['attributes' => $descriptionAttributes]; ?>
<?php $__slotsb37819c81aac29fb817c83348e8798a6 = []; ?>
<?php $__blaze->pushData($__attrsb37819c81aac29fb817c83348e8798a6); ?>
<?php ob_start(); ?><?php echo e($descriptionTrailing); ?><?php $__slotsb37819c81aac29fb817c83348e8798a6['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotsb37819c81aac29fb817c83348e8798a6); ?>
<?php _b37819c81aac29fb817c83348e8798a6($__blaze, $__attrsb37819c81aac29fb817c83348e8798a6, $__slotsb37819c81aac29fb817c83348e8798a6, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb37819c81aac29fb817c83348e8798a6)) { $__slotsb37819c81aac29fb817c83348e8798a6 = array_pop($__slotsStackb37819c81aac29fb817c83348e8798a6); } ?>
<?php if (! empty($__attrsStackb37819c81aac29fb817c83348e8798a6)) { $__attrsb37819c81aac29fb817c83348e8798a6 = array_pop($__attrsStackb37819c81aac29fb817c83348e8798a6); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slots1d208f203a21420691a8e767761f07b8['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots1d208f203a21420691a8e767761f07b8); ?>
<?php _1d208f203a21420691a8e767761f07b8($__blaze, $__attrs1d208f203a21420691a8e767761f07b8, $__slots1d208f203a21420691a8e767761f07b8, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack1d208f203a21420691a8e767761f07b8)) { $__slots1d208f203a21420691a8e767761f07b8 = array_pop($__slotsStack1d208f203a21420691a8e767761f07b8); } ?>
<?php if (! empty($__attrsStack1d208f203a21420691a8e767761f07b8)) { $__attrs1d208f203a21420691a8e767761f07b8 = array_pop($__attrsStack1d208f203a21420691a8e767761f07b8); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH C:\Users\NTATU\Herd\curtainskenya\vendor\livewire\flux\src/../stubs/resources/views/flux/with-field.blade.php ENDPATH**/ ?>