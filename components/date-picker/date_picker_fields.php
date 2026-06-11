<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$date_picker_name_field = (new FieldsBuilder('date_picker_name_fields'));
$date_picker_name_field->addText('name', [
    'label'    => 'Name (HTML)',
    'required' => 1,
]);

$date_picker_label_field = (new FieldsBuilder('date_picker_label_fields'));
$date_picker_label_field->addText('label', ['label' => 'Label']);

$date_picker_placeholder_field = (new FieldsBuilder('date_picker_placeholder_fields'));
$date_picker_placeholder_field->addText('placeholder', [
    'label'         => 'Placeholder',
    'default_value' => 'Pick a date',
]);

$date_picker_selected_field = (new FieldsBuilder('date_picker_selected_fields'));
$date_picker_selected_field->addDatePicker('selected_date', [
    'label'          => 'Default Selected Date',
    'display_format' => 'Y-m-d',
    'return_format'  => 'Y-m-d',
]);

$date_picker_min_field = (new FieldsBuilder('date_picker_min_fields'));
$date_picker_min_field->addDatePicker('min_date', [
    'label'          => 'Minimum Date',
    'display_format' => 'Y-m-d',
    'return_format'  => 'Y-m-d',
]);

$date_picker_max_field = (new FieldsBuilder('date_picker_max_fields'));
$date_picker_max_field->addDatePicker('max_date', [
    'label'          => 'Maximum Date',
    'display_format' => 'Y-m-d',
    'return_format'  => 'Y-m-d',
]);

$date_picker_full_fields = (new FieldsBuilder('date_picker_component_fields'));
$date_picker_full_fields
    ->addFields($date_picker_name_field)
    ->addFields($date_picker_label_field)
    ->addFields($date_picker_placeholder_field)
    ->addFields($date_picker_selected_field)
    ->addFields($date_picker_min_field)
    ->addFields($date_picker_max_field);

return [
    'name'          => $date_picker_name_field,
    'label'         => $date_picker_label_field,
    'placeholder'   => $date_picker_placeholder_field,
    'selected_date' => $date_picker_selected_field,
    'min_date'      => $date_picker_min_field,
    'max_date'      => $date_picker_max_field,
    'full'          => $date_picker_full_fields,
];
