<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$switch_toggle_label_field = (new FieldsBuilder('switch_toggle_label_fields'));
$switch_toggle_label_field->addText('label', ['label' => 'Label']);

$switch_toggle_name_field = (new FieldsBuilder('switch_toggle_name_fields'));
$switch_toggle_name_field->addText('name', ['label' => 'Name (HTML)']);

$switch_toggle_checked_field = (new FieldsBuilder('switch_toggle_checked_fields'));
$switch_toggle_checked_field->addTrueFalse('checked', [
    'label'         => 'Initially On',
    'ui'            => 1,
    'default_value' => 0,
]);

$switch_toggle_disabled_field = (new FieldsBuilder('switch_toggle_disabled_fields'));
$switch_toggle_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$switch_toggle_full_fields = (new FieldsBuilder('switch_toggle_component_fields'));
$switch_toggle_full_fields
    ->addFields($switch_toggle_label_field)
    ->addFields($switch_toggle_name_field)
    ->addFields($switch_toggle_checked_field)
    ->addFields($switch_toggle_disabled_field);

return [
    'label'    => $switch_toggle_label_field,
    'name'     => $switch_toggle_name_field,
    'checked'  => $switch_toggle_checked_field,
    'disabled' => $switch_toggle_disabled_field,
    'full'     => $switch_toggle_full_fields,
];
