<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$label_text_field = (new FieldsBuilder('label_text_fields'));
$label_text_field->addText('text', ['label' => 'Label Text', 'required' => 1]);

$label_for_field = (new FieldsBuilder('label_for_fields'));
$label_for_field->addText('label_for', [
    'label'       => 'For (input ID)',
    'instructions' => 'HTML for attribute — links label to an input by its ID.',
]);

$label_full_fields = (new FieldsBuilder('label_component_fields'));
$label_full_fields
    ->addFields($label_text_field)
    ->addFields($label_for_field);

return [
    'text'      => $label_text_field,
    'label_for' => $label_for_field,
    'full'      => $label_full_fields,
];
