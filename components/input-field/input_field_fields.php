<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$field_label_field = (new FieldsBuilder('field_label_fields'));
$field_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$field_label_for_field = (new FieldsBuilder('field_label_for_fields'));
$field_label_for_field->addText('label_for', [
    'label'        => 'For (input ID)',
    'instructions' => 'Links label to input via HTML for/id pair.',
]);

$field_description_field = (new FieldsBuilder('field_description_fields'));
$field_description_field->addText('description', ['label' => 'Helper Description']);

$field_required_field = (new FieldsBuilder('field_required_fields'));
$field_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$field_error_field = (new FieldsBuilder('field_error_fields'));
$field_error_field->addText('error', [
    'label'        => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$field_type_field = (new FieldsBuilder('field_type_fields'));
$field_type_field->addSelect('field_type', [
    'label'         => 'Input Type',
    'choices'       => [
        'text'     => 'Text',
        'email'    => 'Email',
        'password' => 'Password',
        'number'   => 'Number',
        'tel'      => 'Telephone',
        'url'      => 'URL',
        'search'   => 'Search',
    ],
    'default_value' => 'text',
]);

$field_name_field = (new FieldsBuilder('field_name_fields'));
$field_name_field->addText('name', ['label' => 'Name (HTML)']);

$field_placeholder_field = (new FieldsBuilder('field_placeholder_fields'));
$field_placeholder_field->addText('placeholder', ['label' => 'Placeholder']);

$field_full_fields = (new FieldsBuilder('field_component_fields'));
$field_full_fields
    ->addFields($field_label_field)
    ->addFields($field_label_for_field)
    ->addFields($field_description_field)
    ->addFields($field_required_field)
    ->addFields($field_error_field)
    ->addFields($field_type_field)
    ->addFields($field_name_field)
    ->addFields($field_placeholder_field);

return [
    'label'       => $field_label_field,
    'label_for'   => $field_label_for_field,
    'description' => $field_description_field,
    'required'    => $field_required_field,
    'error'       => $field_error_field,
    'field_type'  => $field_type_field,
    'name'        => $field_name_field,
    'placeholder' => $field_placeholder_field,
    'full'        => $field_full_fields,
];
