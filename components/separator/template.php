<?php

/** @var \Theme\Components\Separator $this */
$orientation = in_array($this->orientation, ['horizontal', 'vertical'], true)
    ? $this->orientation
    : 'horizontal';

$role = $this->decorative ? 'none' : 'separator';

$inner_attrs = $this->compile_attrs([
    'data-slot' => 'separator-root',
    'role' => $role,
    'data-orientation' => $orientation,
]);

if (!$this->decorative) {
    $inner_attrs .= ' aria-orientation="' . esc_attr($orientation) . '"';
}
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?>">
    <div <?= $inner_attrs ?>
        class="shrink-0 bg-border data-[orientation=horizontal]:w-full data-[orientation=horizontal]:h-px data-[orientation=vertical]:w-px data-[orientation=vertical]:h-full">
    </div>
</div>
