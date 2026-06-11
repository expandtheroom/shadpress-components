<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$input_type_field = (new FieldsBuilder('input_type_fields'));
$input_type_field->addSelect('type', [
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

$input_name_field = (new FieldsBuilder('input_name_fields'));
$input_name_field->addText('name', ['label' => 'Name (HTML)']);

$input_id_field = (new FieldsBuilder('input_id_fields'));
$input_id_field->addText('id', ['label' => 'ID (HTML)']);

$input_placeholder_field = (new FieldsBuilder('input_placeholder_fields'));
$input_placeholder_field->addText('placeholder', ['label' => 'Placeholder']);

$input_default_value_field = (new FieldsBuilder('input_default_value_fields'));
$input_default_value_field->addText('default_value', ['label' => 'Default Value']);

$input_required_field = (new FieldsBuilder('input_required_fields'));
$input_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$input_disabled_field = (new FieldsBuilder('input_disabled_fields'));
$input_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$input_readonly_field = (new FieldsBuilder('input_readonly_fields'));
$input_readonly_field->addTrueFalse('readonly', [
    'label'         => 'Read Only',
    'ui'            => 1,
    'default_value' => 0,
]);

$input_full_fields = (new FieldsBuilder('input_component_fields'));
$input_full_fields
    ->addFields($input_type_field)
    ->addFields($input_name_field)
    ->addFields($input_id_field)
    ->addFields($input_placeholder_field)
    ->addFields($input_default_value_field)
    ->addFields($input_required_field)
    ->addFields($input_disabled_field)
    ->addFields($input_readonly_field);

return [
    'type'          => $input_type_field,
    'name'          => $input_name_field,
    'id'            => $input_id_field,
    'placeholder'   => $input_placeholder_field,
    'default_value' => $input_default_value_field,
    'required'      => $input_required_field,
    'disabled'      => $input_disabled_field,
    'readonly'      => $input_readonly_field,
    'full'          => $input_full_fields,
];
