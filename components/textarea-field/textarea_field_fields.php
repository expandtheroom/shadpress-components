<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$textarea_field_label_field = (new FieldsBuilder('textarea_field_label_fields'));
$textarea_field_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$textarea_field_description_field = (new FieldsBuilder('textarea_field_description_fields'));
$textarea_field_description_field->addText('description', ['label' => 'Helper Description']);

$textarea_field_required_field = (new FieldsBuilder('textarea_field_required_fields'));
$textarea_field_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$textarea_field_error_field = (new FieldsBuilder('textarea_field_error_fields'));
$textarea_field_error_field->addText('error', [
    'label'        => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$textarea_field_placeholder_field = (new FieldsBuilder('textarea_field_placeholder_fields'));
$textarea_field_placeholder_field->addText('placeholder', ['label' => 'Placeholder']);

$textarea_field_rows_field = (new FieldsBuilder('textarea_field_rows_fields'));
$textarea_field_rows_field->addNumber('rows', [
    'label'         => 'Rows',
    'default_value' => 4,
    'min'           => 1,
]);

$textarea_field_disabled_field = (new FieldsBuilder('textarea_field_disabled_fields'));
$textarea_field_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$textarea_field_readonly_field = (new FieldsBuilder('textarea_field_readonly_fields'));
$textarea_field_readonly_field->addTrueFalse('readonly', [
    'label'         => 'Read Only',
    'ui'            => 1,
    'default_value' => 0,
]);

$textarea_field_full_fields = (new FieldsBuilder('textarea_field_component_fields'));
$textarea_field_full_fields
    ->addFields($textarea_field_label_field)
    ->addFields($textarea_field_description_field)
    ->addFields($textarea_field_required_field)
    ->addFields($textarea_field_error_field)
    ->addFields($textarea_field_placeholder_field)
    ->addFields($textarea_field_rows_field)
    ->addFields($textarea_field_disabled_field)
    ->addFields($textarea_field_readonly_field);

return [
    'label'       => $textarea_field_label_field,
    'description' => $textarea_field_description_field,
    'required'    => $textarea_field_required_field,
    'error'       => $textarea_field_error_field,
    'placeholder' => $textarea_field_placeholder_field,
    'rows'        => $textarea_field_rows_field,
    'disabled'    => $textarea_field_disabled_field,
    'readonly'    => $textarea_field_readonly_field,
    'full'        => $textarea_field_full_fields,
];
