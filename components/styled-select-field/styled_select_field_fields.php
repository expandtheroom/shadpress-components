<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$select_label_field = (new FieldsBuilder('select_label_fields'));
$select_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$select_label_for_field = (new FieldsBuilder('select_label_for_fields'));
$select_label_for_field->addText('label_for', [
    'label' => 'For (trigger ID)',
    'instructions' => 'Links label to the select trigger via HTML for/id pair.',
]);

$select_description_field = (new FieldsBuilder('select_description_fields'));
$select_description_field->addText('description', ['label' => 'Helper Description']);

$select_required_field = (new FieldsBuilder('select_required_fields'));
$select_required_field->addTrueFalse('required', [
    'label' => 'Required',
    'ui' => 1,
    'default_value' => 0,
]);

$select_error_field = (new FieldsBuilder('select_error_fields'));
$select_error_field->addText('error', [
    'label' => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$select_name_field = (new FieldsBuilder('select_name_fields'));
$select_name_field->addText('name', ['label' => 'Name (HTML)']);

$select_placeholder_field = (new FieldsBuilder('select_placeholder_fields'));
$select_placeholder_field->addText('placeholder', [
    'label' => 'Placeholder',
    'default_value' => 'Select an option',
]);

$select_options_field = (new FieldsBuilder('select_options_fields'));
$select_options_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'block'])
    ->addText('label', ['label' => 'Label', 'required' => 0])
    ->addText('value', ['label' => 'Value', 'required' => 1])
    ->endRepeater();

$select_disabled_field = (new FieldsBuilder('select_disabled_fields'));
$select_disabled_field->addTrueFalse('disabled', [
    'label' => 'Disabled',
    'ui' => 1,
    'default_value' => 0,
]);

$select_full_fields = (new FieldsBuilder('select_component_fields'));
$select_full_fields
    ->addFields($select_label_field)
    ->addFields($select_label_for_field)
    ->addFields($select_description_field)
    ->addFields($select_required_field)
    ->addFields($select_error_field)
    ->addFields($select_name_field)
    ->addFields($select_placeholder_field)
    ->addFields($select_options_field)
    ->addFields($select_disabled_field);

return [
    'label' => $select_label_field,
    'label_for' => $select_label_for_field,
    'description' => $select_description_field,
    'required' => $select_required_field,
    'error' => $select_error_field,
    'name' => $select_name_field,
    'placeholder' => $select_placeholder_field,
    'options' => $select_options_field,
    'disabled' => $select_disabled_field,
    'full' => $select_full_fields,
];
