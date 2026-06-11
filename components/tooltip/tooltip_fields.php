<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$tooltip_trigger_label_field = (new FieldsBuilder('tooltip_trigger_label_fields'));
$tooltip_trigger_label_field->addText('trigger_label', ['label' => 'Trigger Text', 'required' => 1]);

$tooltip_content_field = (new FieldsBuilder('tooltip_content_fields'));
$tooltip_content_field->addText('tooltip_content', ['label' => 'Tooltip Content', 'required' => 1]);

$side_choices = [
    'top'    => 'Top',
    'bottom' => 'Bottom',
    'left'   => 'Left',
    'right'  => 'Right',
];

$tooltip_side_field = (new FieldsBuilder('tooltip_side_fields'));
$tooltip_side_field->addSelect('side', [
    'label'         => 'Side',
    'choices'       => $side_choices,
    'default_value' => 'top',
]);

$tooltip_full_fields = (new FieldsBuilder('tooltip_component_fields'));
$tooltip_full_fields
    ->addFields($tooltip_trigger_label_field)
    ->addFields($tooltip_content_field)
    ->addFields($tooltip_side_field);

return [
    'trigger_label' => $tooltip_trigger_label_field,
    'content'       => $tooltip_content_field,
    'side'          => $tooltip_side_field,
    'side_choices'  => $side_choices,
    'full'          => $tooltip_full_fields,
];
