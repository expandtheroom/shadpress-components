<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$cbf_label_field = (new FieldsBuilder('cbf_label_fields'));
$cbf_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$cbf_description_field = (new FieldsBuilder('cbf_description_fields'));
$cbf_description_field->addText('description', ['label' => 'Helper Description']);

$cbf_required_field = (new FieldsBuilder('cbf_required_fields'));
$cbf_required_field->addTrueFalse('required', [
    'label' => 'Required',
    'ui' => 1,
    'default_value' => 0,
]);

$cbf_error_field = (new FieldsBuilder('cbf_error_fields'));
$cbf_error_field->addText('error', [
    'label' => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$cbf_name_field = (new FieldsBuilder('cbf_name_fields'));
$cbf_name_field->addText('name', ['label' => 'Name (HTML)']);

$cbf_value_field = (new FieldsBuilder('cbf_value_fields'));
$cbf_value_field->addText('value', [
    'label' => 'Value',
    'default_value' => '1',
    'instructions' => 'Value submitted when checked.',
]);

$cbf_checked_field = (new FieldsBuilder('cbf_checked_fields'));
$cbf_checked_field->addTrueFalse('checked', [
    'label' => 'Initially Checked',
    'ui' => 1,
    'default_value' => 0,
]);

$cbf_disabled_field = (new FieldsBuilder('cbf_disabled_fields'));
$cbf_disabled_field->addTrueFalse('disabled', [
    'label' => 'Disabled',
    'ui' => 1,
    'default_value' => 0,
]);

$cbf_full_fields = (new FieldsBuilder('checkbox_field_component_fields'));
$cbf_full_fields
    ->addFields($cbf_label_field)
    ->addFields($cbf_description_field)
    ->addFields($cbf_required_field)
    ->addFields($cbf_error_field)
    ->addFields($cbf_name_field)
    ->addFields($cbf_value_field)
    ->addFields($cbf_checked_field)
    ->addFields($cbf_disabled_field);

return [
    'checked' => $cbf_checked_field,
    'description' => $cbf_description_field,
    'disabled' => $cbf_disabled_field,
    'error' => $cbf_error_field,
    'label' => $cbf_label_field,
    'name' => $cbf_name_field,
    'required' => $cbf_required_field,
    'value' => $cbf_value_field,
    'full' => $cbf_full_fields,
];
