<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$popover_trigger_field = (new FieldsBuilder('popover_trigger_fields'));
$popover_trigger_field->addText('trigger_label', [
    'label'    => 'Trigger Label',
    'required' => 1,
]);

// Import variant choices from Button — single source of truth.
$button_fields           = require get_stylesheet_directory() . '/components/button/button_fields.php';
$trigger_variant_choices = $button_fields['variant_choices'];

$popover_trigger_variant_field = (new FieldsBuilder('popover_trigger_variant_fields'));
$popover_trigger_variant_field->addSelect('trigger_variant', [
    'label'         => 'Trigger Variant',
    'choices'       => $trigger_variant_choices,
    'default_value' => 'outline',
]);

$popover_content_field = (new FieldsBuilder('popover_content_fields'));
$popover_content_field->addWysiwyg('body', [
    'label' => 'Popover Content',
]);

$side_choices = [
    'bottom' => 'Bottom',
    'top'    => 'Top',
    'left'   => 'Left',
    'right'  => 'Right',
];
$popover_side_field = (new FieldsBuilder('popover_side_fields'));
$popover_side_field->addSelect('side', [
    'label'         => 'Side',
    'choices'       => $side_choices,
    'default_value' => 'bottom',
]);

$align_choices = [
    'center' => 'Center',
    'start'  => 'Start',
    'end'    => 'End',
];
$popover_align_field = (new FieldsBuilder('popover_align_fields'));
$popover_align_field->addSelect('align', [
    'label'         => 'Alignment',
    'choices'       => $align_choices,
    'default_value' => 'center',
]);

$popover_full_fields = (new FieldsBuilder('popover_component_fields'));
$popover_full_fields
    ->addFields($popover_trigger_field)
    ->addFields($popover_trigger_variant_field)
    ->addFields($popover_content_field)
    ->addFields($popover_side_field)
    ->addFields($popover_align_field);

return [
    'trigger_label'           => $popover_trigger_field,
    'trigger_variant'         => $popover_trigger_variant_field,
    'trigger_variant_choices' => $trigger_variant_choices,
    'body'                    => $popover_content_field,
    'side'                    => $popover_side_field,
    'side_choices'            => $side_choices,
    'align'                   => $popover_align_field,
    'align_choices'           => $align_choices,
    'full'                    => $popover_full_fields,
];
