<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$calendar_name_field = (new FieldsBuilder('calendar_name_fields'));
$calendar_name_field->addText('name', ['label' => 'Name (HTML)']);

$calendar_selected_field = (new FieldsBuilder('calendar_selected_fields'));
$calendar_selected_field->addDatePicker('selected_date', [
    'label'          => 'Default Selected Date',
    'display_format' => 'Y-m-d',
    'return_format'  => 'Y-m-d',
]);

$calendar_min_field = (new FieldsBuilder('calendar_min_fields'));
$calendar_min_field->addDatePicker('min_date', [
    'label'          => 'Minimum Date',
    'display_format' => 'Y-m-d',
    'return_format'  => 'Y-m-d',
]);

$calendar_max_field = (new FieldsBuilder('calendar_max_fields'));
$calendar_max_field->addDatePicker('max_date', [
    'label'          => 'Maximum Date',
    'display_format' => 'Y-m-d',
    'return_format'  => 'Y-m-d',
]);

$calendar_full_fields = (new FieldsBuilder('calendar_component_fields'));
$calendar_full_fields
    ->addFields($calendar_name_field)
    ->addFields($calendar_selected_field)
    ->addFields($calendar_min_field)
    ->addFields($calendar_max_field);

return [
    'name'          => $calendar_name_field,
    'selected_date' => $calendar_selected_field,
    'min_date'      => $calendar_min_field,
    'max_date'      => $calendar_max_field,
    'full'          => $calendar_full_fields,
];
