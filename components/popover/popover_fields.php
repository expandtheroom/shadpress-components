<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$popover_trigger_field = (new FieldsBuilder('popover_trigger_fields'));
$popover_trigger_field->addText('trigger_label', [
    'label'    => 'Trigger Label',
    'required' => 1,
]);

$popover_content_field = (new FieldsBuilder('popover_content_fields'));
$popover_content_field->addWysiwyg('body', [
    'label' => 'Popover Content',
]);

$popover_side_field = (new FieldsBuilder('popover_side_fields'));
$popover_side_field->addSelect('side', [
    'label'         => 'Side',
    'choices'       => [
        'bottom' => 'Bottom',
        'top'    => 'Top',
        'left'   => 'Left',
        'right'  => 'Right',
    ],
    'default_value' => 'bottom',
]);

$popover_align_field = (new FieldsBuilder('popover_align_fields'));
$popover_align_field->addSelect('align', [
    'label'         => 'Alignment',
    'choices'       => [
        'center' => 'Center',
        'start'  => 'Start',
        'end'    => 'End',
    ],
    'default_value' => 'center',
]);

$popover_full_fields = (new FieldsBuilder('popover_component_fields'));
$popover_full_fields
    ->addFields($popover_trigger_field)
    ->addFields($popover_content_field)
    ->addFields($popover_side_field)
    ->addFields($popover_align_field);

return [
    'trigger_label' => $popover_trigger_field,
    'body'          => $popover_content_field,
    'side'          => $popover_side_field,
    'align'         => $popover_align_field,
    'full'          => $popover_full_fields,
];
