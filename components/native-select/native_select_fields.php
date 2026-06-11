<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$native_select_name_field = (new FieldsBuilder('native_select_name_fields'));
$native_select_name_field->addText('name', ['label' => 'Name (HTML)']);

$native_select_id_field = (new FieldsBuilder('native_select_id_fields'));
$native_select_id_field->addText('id', ['label' => 'ID (HTML)']);

$native_select_placeholder_field = (new FieldsBuilder('native_select_placeholder_fields'));
$native_select_placeholder_field->addText('placeholder', [
    'label'        => 'Placeholder',
    'instructions' => 'Optional. Renders as first empty option.',
]);

$native_select_items_field = (new FieldsBuilder('native_select_items_fields'));
$native_select_items_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'table'])
        ->addText('label', ['label' => 'Label', 'required' => 1])
        ->addText('value', ['label' => 'Value', 'required' => 1])
    ->endRepeater();

$native_select_required_field = (new FieldsBuilder('native_select_required_fields'));
$native_select_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$native_select_disabled_field = (new FieldsBuilder('native_select_disabled_fields'));
$native_select_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$native_select_full_fields = (new FieldsBuilder('native_select_component_fields'));
$native_select_full_fields
    ->addFields($native_select_name_field)
    ->addFields($native_select_id_field)
    ->addFields($native_select_placeholder_field)
    ->addFields($native_select_items_field)
    ->addFields($native_select_required_field)
    ->addFields($native_select_disabled_field);

return [
    'name'        => $native_select_name_field,
    'id'          => $native_select_id_field,
    'placeholder' => $native_select_placeholder_field,
    'options'     => $native_select_items_field,
    'required'    => $native_select_required_field,
    'disabled'    => $native_select_disabled_field,
    'full'        => $native_select_full_fields,
];
