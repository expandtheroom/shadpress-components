<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$radio_group_label_field = (new FieldsBuilder('radio_group_label_fields'));
$radio_group_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$radio_group_label_for_field = (new FieldsBuilder('radio_group_label_for_fields'));
$radio_group_label_for_field->addText('label_for', [
    'label' => 'Label ID',
    'instructions' => 'ID applied to the group label and referenced by the radiogroup via aria-labelledby. Optional; falls back to the name.',
]);

$radio_group_description_field = (new FieldsBuilder('radio_group_description_fields'));
$radio_group_description_field->addText('description', ['label' => 'Helper Description']);

$radio_group_required_field = (new FieldsBuilder('radio_group_required_fields'));
$radio_group_required_field->addTrueFalse('required', [
    'label' => 'Required',
    'ui' => 1,
    'default_value' => 0,
]);

$radio_group_error_field = (new FieldsBuilder('radio_group_error_fields'));
$radio_group_error_field->addText('error', [
    'label' => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$radio_group_name_field = (new FieldsBuilder('radio_group_name_fields'));
$radio_group_name_field->addText('name', ['label' => 'Name (HTML)']);

$radio_group_options_field = (new FieldsBuilder('radio_group_options_fields'));
$radio_group_options_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'block'])
    ->addText('label', ['label' => 'Label', 'required' => 0])
    ->addText('value', ['label' => 'Value', 'required' => 1])
    ->endRepeater();

$radio_group_default_field = (new FieldsBuilder('radio_group_default_fields'));
$radio_group_default_field->addText('default_value', ['label' => 'Default Selected Value']);

$radio_group_disabled_field = (new FieldsBuilder('radio_group_disabled_fields'));
$radio_group_disabled_field->addTrueFalse('disabled', [
    'label' => 'Disabled',
    'ui' => 1,
    'default_value' => 0,
]);

$radio_group_orientation_field = (new FieldsBuilder('radio_group_orientation_fields'));
$radio_group_orientation_field->addSelect('orientation', [
    'label' => 'Orientation',
    'choices' => [
        'vertical' => 'Vertical',
        'horizontal' => 'Horizontal',
    ],
    'default_value' => 'vertical',
]);

$radio_group_full_fields = (new FieldsBuilder('radio_group_component_fields'));
$radio_group_full_fields
    ->addFields($radio_group_label_field)
    ->addFields($radio_group_label_for_field)
    ->addFields($radio_group_description_field)
    ->addFields($radio_group_required_field)
    ->addFields($radio_group_error_field)
    ->addFields($radio_group_name_field)
    ->addFields($radio_group_options_field)
    ->addFields($radio_group_default_field)
    ->addFields($radio_group_disabled_field)
    ->addFields($radio_group_orientation_field);

return [
    'label' => $radio_group_label_field,
    'label_for' => $radio_group_label_for_field,
    'description' => $radio_group_description_field,
    'required' => $radio_group_required_field,
    'error' => $radio_group_error_field,
    'name' => $radio_group_name_field,
    'options' => $radio_group_options_field,
    'default_value' => $radio_group_default_field,
    'disabled' => $radio_group_disabled_field,
    'orientation' => $radio_group_orientation_field,
    'full' => $radio_group_full_fields,
];
