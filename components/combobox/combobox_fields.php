<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$combobox_name_field = (new FieldsBuilder('combobox_name_fields'));
$combobox_name_field->addText('name', ['label' => 'Name (HTML)']);

$combobox_placeholder_field = (new FieldsBuilder('combobox_placeholder_fields'));
$combobox_placeholder_field->addText('placeholder', [
    'label' => 'Placeholder',
    'default_value' => 'Search...',
]);

$combobox_items_field = (new FieldsBuilder('combobox_items_fields'));
$combobox_items_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'block'])
    ->addText('label', ['label' => 'Label', 'required' => 1])
    ->addText('value', ['label' => 'Value', 'required' => 1])
    ->endRepeater();

$combobox_full_fields = (new FieldsBuilder('combobox_component_fields'));
$combobox_full_fields
    ->addFields($combobox_name_field)
    ->addFields($combobox_placeholder_field)
    ->addFields($combobox_items_field);

return [
    'name' => $combobox_name_field,
    'placeholder' => $combobox_placeholder_field,
    'options' => $combobox_items_field,
    'full' => $combobox_full_fields,
];
