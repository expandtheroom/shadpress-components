<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$input_group_prefix_field = (new FieldsBuilder('input_group_prefix_fields'));
$input_group_prefix_field->addText('prefix', [
    'label'        => 'Prefix Addon',
    'instructions' => 'Optional text shown before the input (e.g. "$").',
]);

$input_group_suffix_field = (new FieldsBuilder('input_group_suffix_fields'));
$input_group_suffix_field->addText('suffix', [
    'label'        => 'Suffix Addon',
    'instructions' => 'Optional text shown after the input (e.g. ".com").',
]);

$input_group_type_field = (new FieldsBuilder('input_group_type_fields'));
$input_group_type_field->addSelect('type', [
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

$input_group_name_field = (new FieldsBuilder('input_group_name_fields'));
$input_group_name_field->addText('name', ['label' => 'Name (HTML)']);

$input_group_id_field = (new FieldsBuilder('input_group_id_fields'));
$input_group_id_field->addText('id', ['label' => 'ID (HTML)']);

$input_group_placeholder_field = (new FieldsBuilder('input_group_placeholder_fields'));
$input_group_placeholder_field->addText('placeholder', ['label' => 'Placeholder']);

$input_group_required_field = (new FieldsBuilder('input_group_required_fields'));
$input_group_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$input_group_disabled_field = (new FieldsBuilder('input_group_disabled_fields'));
$input_group_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$input_group_full_fields = (new FieldsBuilder('input_group_component_fields'));
$input_group_full_fields
    ->addFields($input_group_prefix_field)
    ->addFields($input_group_suffix_field)
    ->addFields($input_group_type_field)
    ->addFields($input_group_name_field)
    ->addFields($input_group_id_field)
    ->addFields($input_group_placeholder_field)
    ->addFields($input_group_required_field)
    ->addFields($input_group_disabled_field);

return [
    'prefix'      => $input_group_prefix_field,
    'suffix'      => $input_group_suffix_field,
    'type'        => $input_group_type_field,
    'name'        => $input_group_name_field,
    'id'          => $input_group_id_field,
    'placeholder' => $input_group_placeholder_field,
    'required'    => $input_group_required_field,
    'disabled'    => $input_group_disabled_field,
    'full'        => $input_group_full_fields,
];
