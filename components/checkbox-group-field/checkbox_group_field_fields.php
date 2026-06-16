<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$checkbox_group_label_field = (new FieldsBuilder('checkbox_group_label_fields'));
$checkbox_group_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$checkbox_group_label_for_field = (new FieldsBuilder('checkbox_group_label_for_fields'));
$checkbox_group_label_for_field->addText('label_for', [
    'label'        => 'Label ID',
    'instructions' => 'ID applied to the group label and referenced by the group via aria-labelledby. Optional; falls back to the name.',
]);

$checkbox_group_description_field = (new FieldsBuilder('checkbox_group_description_fields'));
$checkbox_group_description_field->addText('description', ['label' => 'Helper Description']);

$checkbox_group_required_field = (new FieldsBuilder('checkbox_group_required_fields'));
$checkbox_group_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$checkbox_group_error_field = (new FieldsBuilder('checkbox_group_error_fields'));
$checkbox_group_error_field->addText('error', [
    'label'        => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$checkbox_group_name_field = (new FieldsBuilder('checkbox_group_name_fields'));
$checkbox_group_name_field->addText('name', ['label' => 'Name (HTML)']);

$checkbox_group_options_field = (new FieldsBuilder('checkbox_group_options_fields'));
$checkbox_group_options_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'block'])
    ->addText('label', ['label' => 'Label', 'required' => 0])
    ->addText('value', ['label' => 'Value', 'required' => 1])
    ->addTrueFalse('checked', [
        'label'         => 'Checked by Default',
        'ui'            => 1,
        'default_value' => 0,
    ])
    ->endRepeater();

$checkbox_group_orientation_field = (new FieldsBuilder('checkbox_group_orientation_fields'));
$checkbox_group_orientation_field->addSelect('orientation', [
    'label'         => 'Orientation',
    'choices'       => [
        'vertical'   => 'Vertical',
        'horizontal' => 'Horizontal',
    ],
    'default_value' => 'vertical',
]);

$checkbox_group_full_fields = (new FieldsBuilder('checkbox_group_component_fields'));
$checkbox_group_full_fields
    ->addFields($checkbox_group_label_field)
    ->addFields($checkbox_group_label_for_field)
    ->addFields($checkbox_group_description_field)
    ->addFields($checkbox_group_required_field)
    ->addFields($checkbox_group_error_field)
    ->addFields($checkbox_group_name_field)
    ->addFields($checkbox_group_options_field)
    ->addFields($checkbox_group_orientation_field);

return [
    'label'       => $checkbox_group_label_field,
    'label_for'   => $checkbox_group_label_for_field,
    'description' => $checkbox_group_description_field,
    'required'    => $checkbox_group_required_field,
    'error'       => $checkbox_group_error_field,
    'name'        => $checkbox_group_name_field,
    'options'     => $checkbox_group_options_field,
    'orientation' => $checkbox_group_orientation_field,
    'full'        => $checkbox_group_full_fields,
];
