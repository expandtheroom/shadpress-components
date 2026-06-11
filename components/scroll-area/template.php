<?php
/** @var \Theme\Components\ScrollArea $this */
$allowed_orientations = ['vertical', 'horizontal', 'both'];
$orientation = in_array($this->orientation, $allowed_orientations, true) ? $this->orientation : 'vertical';

$max_height = $this->max_height ?: '300px';
if ( ! preg_match( '/^[\d.]+(px|rem|em|vh|vw|%)$/', trim( $max_height ) ) ) {
    $max_height = '300px';
}
?>
<div <?= $this->component_attrs() ?>>
    <div data-slot="scroll-area"
         data-orientation="<?= esc_attr($orientation) ?>"
         style="max-height: <?= esc_attr($max_height) ?>">
        <div data-slot="scroll-area-viewport">
            <?= $this->body_component ?>
        </div>
    </div>
</div>
