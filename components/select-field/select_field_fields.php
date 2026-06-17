<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$native_select_field_label_field = (new FieldsBuilder('native_select_field_label_fields'));
$native_select_field_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$native_select_field_description_field = (new FieldsBuilder('native_select_field_description_fields'));
$native_select_field_description_field->addText('description', ['label' => 'Helper Description']);

$native_select_field_required_field = (new FieldsBuilder('native_select_field_required_fields'));
$native_select_field_required_field->addTrueFalse('required', [
    'label' => 'Required',
    'ui' => 1,
    'default_value' => 0,
]);

$native_select_field_error_field = (new FieldsBuilder('native_select_field_error_fields'));
$native_select_field_error_field->addText('error', [
    'label' => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$native_select_field_placeholder_field = (new FieldsBuilder('native_select_field_placeholder_fields'));
$native_select_field_placeholder_field->addText('placeholder', [
    'label' => 'Placeholder',
    'instructions' => 'Optional. Renders as first empty option.',
]);

$native_select_field_options_field = (new FieldsBuilder('native_select_field_options_fields'));
$native_select_field_options_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'block'])
    ->addText('label', ['label' => 'Label', 'required' => 0])
    ->addText('value', ['label' => 'Value', 'required' => 1])
    ->endRepeater();

$native_select_field_disabled_field = (new FieldsBuilder('native_select_field_disabled_fields'));
$native_select_field_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$native_select_field_full_fields = (new FieldsBuilder('native_select_field_component_fields'));
$native_select_field_full_fields
    ->addFields($native_select_field_label_field)
    ->addFields($native_select_field_description_field)
    ->addFields($native_select_field_required_field)
    ->addFields($native_select_field_error_field)
    ->addFields($native_select_field_placeholder_field)
    ->addFields($native_select_field_options_field)
    ->addFields($native_select_field_disabled_field);

return [
    'label' => $native_select_field_label_field,
    'description' => $native_select_field_description_field,
    'required' => $native_select_field_required_field,
    'error' => $native_select_field_error_field,
    'placeholder' => $native_select_field_placeholder_field,
    'options' => $native_select_field_options_field,
    'disabled' => $native_select_field_disabled_field,
    'full' => $native_select_field_full_fields,
];
