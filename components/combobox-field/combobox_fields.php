<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$combobox_label_field = (new FieldsBuilder('combobox_label_fields'));
$combobox_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$combobox_label_for_field = (new FieldsBuilder('combobox_label_for_fields'));
$combobox_label_for_field->addText('label_for', [
    'label'        => 'For (input ID)',
    'instructions' => 'Links label to the combobox input via HTML for/id pair.',
]);

$combobox_description_field = (new FieldsBuilder('combobox_description_fields'));
$combobox_description_field->addText('description', ['label' => 'Helper Description']);

$combobox_required_field = (new FieldsBuilder('combobox_required_fields'));
$combobox_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$combobox_error_field = (new FieldsBuilder('combobox_error_fields'));
$combobox_error_field->addText('error', [
    'label'        => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$combobox_name_field = (new FieldsBuilder('combobox_name_fields'));
$combobox_name_field->addText('name', ['label' => 'Name (HTML)']);

$combobox_placeholder_field = (new FieldsBuilder('combobox_placeholder_fields'));
$combobox_placeholder_field->addText('placeholder', [
    'label'         => 'Placeholder',
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
    ->addFields($combobox_label_field)
    ->addFields($combobox_label_for_field)
    ->addFields($combobox_description_field)
    ->addFields($combobox_required_field)
    ->addFields($combobox_error_field)
    ->addFields($combobox_name_field)
    ->addFields($combobox_placeholder_field)
    ->addFields($combobox_items_field);

return [
    'label'       => $combobox_label_field,
    'label_for'   => $combobox_label_for_field,
    'description' => $combobox_description_field,
    'required'    => $combobox_required_field,
    'error'       => $combobox_error_field,
    'name'        => $combobox_name_field,
    'placeholder' => $combobox_placeholder_field,
    'options'     => $combobox_items_field,
    'full'        => $combobox_full_fields,
];
