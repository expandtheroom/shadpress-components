<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$checkbox_label_field = (new FieldsBuilder('checkbox_label_fields'));
$checkbox_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$checkbox_name_field = (new FieldsBuilder('checkbox_name_fields'));
$checkbox_name_field->addText('name', ['label' => 'Name (HTML)']);

$checkbox_value_field = (new FieldsBuilder('checkbox_value_fields'));
$checkbox_value_field->addText('value', [
    'label'         => 'Value',
    'default_value' => '1',
    'instructions'  => 'Value submitted when checked.',
]);

$checkbox_checked_field = (new FieldsBuilder('checkbox_checked_fields'));
$checkbox_checked_field->addTrueFalse('checked', [
    'label'         => 'Initially Checked',
    'ui'            => 1,
    'default_value' => 0,
]);

$checkbox_disabled_field = (new FieldsBuilder('checkbox_disabled_fields'));
$checkbox_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$checkbox_full_fields = (new FieldsBuilder('checkbox_component_fields'));
$checkbox_full_fields
    ->addFields($checkbox_label_field)
    ->addFields($checkbox_name_field)
    ->addFields($checkbox_value_field)
    ->addFields($checkbox_checked_field)
    ->addFields($checkbox_disabled_field);

return [
    'label'    => $checkbox_label_field,
    'name'     => $checkbox_name_field,
    'value'    => $checkbox_value_field,
    'checked'  => $checkbox_checked_field,
    'disabled' => $checkbox_disabled_field,
    'full'     => $checkbox_full_fields,
];
