<?php

/** @var \Theme\Components\ScrollArea $this */
$allowed_orientations = ['vertical', 'horizontal', 'both'];
$orientation = in_array($this->orientation, $allowed_orientations, true) ? $this->orientation : 'vertical';

$max_height = $this->max_height ?: '300px';
if (! preg_match('/^[\d.]+(px|rem|em|vh|vw|%)$/', trim($max_height))) {
    $max_height = '300px';
}
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?>">
    <div data-slot="scroll-area"
        data-orientation="<?= esc_attr($orientation) ?>"
        style="max-height: <?= esc_attr($max_height) ?>"
        class="overflow-auto scrollbar-thin [scrollbar-color:var(--color-border)_transparent] data-[orientation=vertical]:overflow-x-hidden data-[orientation=vertical]:overflow-y-auto data-[orientation=horizontal]:overflow-x-auto data-[orientation=horizontal]:overflow-y-hidden data-[orientation=both]:overflow-auto [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar]:h-1.5 [&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar-thumb]:bg-border [&::-webkit-scrollbar-thumb]:rounded-full">
        <div data-slot="scroll-area-viewport" class="min-w-full">
            <?= $this->body_component ?>
        </div>
    </div>
</div>
