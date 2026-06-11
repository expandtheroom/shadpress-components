<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$textarea_name_field = (new FieldsBuilder('textarea_name_fields'));
$textarea_name_field->addText('name', ['label' => 'Name (HTML)']);

$textarea_id_field = (new FieldsBuilder('textarea_id_fields'));
$textarea_id_field->addText('id', ['label' => 'ID (HTML)']);

$textarea_placeholder_field = (new FieldsBuilder('textarea_placeholder_fields'));
$textarea_placeholder_field->addText('placeholder', ['label' => 'Placeholder']);

$textarea_rows_field = (new FieldsBuilder('textarea_rows_fields'));
$textarea_rows_field->addNumber('rows', [
    'label'         => 'Rows',
    'default_value' => 4,
    'min'           => 1,
]);

$textarea_required_field = (new FieldsBuilder('textarea_required_fields'));
$textarea_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$textarea_disabled_field = (new FieldsBuilder('textarea_disabled_fields'));
$textarea_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$textarea_readonly_field = (new FieldsBuilder('textarea_readonly_fields'));
$textarea_readonly_field->addTrueFalse('readonly', [
    'label'         => 'Read Only',
    'ui'            => 1,
    'default_value' => 0,
]);

$textarea_full_fields = (new FieldsBuilder('textarea_component_fields'));
$textarea_full_fields
    ->addFields($textarea_name_field)
    ->addFields($textarea_id_field)
    ->addFields($textarea_placeholder_field)
    ->addFields($textarea_rows_field)
    ->addFields($textarea_required_field)
    ->addFields($textarea_disabled_field)
    ->addFields($textarea_readonly_field);

return [
    'name'        => $textarea_name_field,
    'id'          => $textarea_id_field,
    'placeholder' => $textarea_placeholder_field,
    'rows'        => $textarea_rows_field,
    'required'    => $textarea_required_field,
    'disabled'    => $textarea_disabled_field,
    'readonly'    => $textarea_readonly_field,
    'full'        => $textarea_full_fields,
];
