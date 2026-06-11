<?php
/** @var \Theme\Components\Separator $this */
$orientation = in_array($this->orientation, ['horizontal', 'vertical'], true)
    ? $this->orientation
    : 'horizontal';

$role = $this->decorative ? 'none' : 'separator';

$inner_attrs = $this->compile_attrs([
    'data-slot'        => 'separator-root',
    'role'             => $role,
    'data-orientation' => $orientation,
]);

if (! $this->decorative) {
    $inner_attrs .= ' aria-orientation="' . esc_attr($orientation) . '"';
}
?>
<div <?= $this->component_attrs() ?>>
    <div <?= $inner_attrs ?>></div>
</div>
