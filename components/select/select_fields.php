<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$select_name_field = (new FieldsBuilder('select_name_fields'));
$select_name_field->addText('name', ['label' => 'Name (HTML)']);

$select_placeholder_field = (new FieldsBuilder('select_placeholder_fields'));
$select_placeholder_field->addText('placeholder', [
    'label'         => 'Placeholder',
    'default_value' => 'Select an option',
]);

$select_items_field = (new FieldsBuilder('select_items_fields'));
$select_items_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'table'])
        ->addText('label', ['label' => 'Label', 'required' => 1])
        ->addText('value', ['label' => 'Value', 'required' => 1])
    ->endRepeater();

$select_disabled_field = (new FieldsBuilder('select_disabled_fields'));
$select_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$select_full_fields = (new FieldsBuilder('select_component_fields'));
$select_full_fields
    ->addFields($select_name_field)
    ->addFields($select_placeholder_field)
    ->addFields($select_items_field)
    ->addFields($select_disabled_field);

return [
    'name'        => $select_name_field,
    'placeholder' => $select_placeholder_field,
    'options'     => $select_items_field,
    'disabled'    => $select_disabled_field,
    'full'        => $select_full_fields,
];
