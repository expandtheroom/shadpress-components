<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$radio_group_name_field = (new FieldsBuilder('radio_group_name_fields'));
$radio_group_name_field->addText('name', ['label' => 'Name (HTML)']);

$radio_group_label_field = (new FieldsBuilder('radio_group_label_fields'));
$radio_group_label_field->addText('label', ['label' => 'Label (Accessible Name)']);

$radio_group_items_field = (new FieldsBuilder('radio_group_items_fields'));
$radio_group_items_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'table'])
        ->addText('label', ['label' => 'Label', 'required' => 1])
        ->addText('value', ['label' => 'Value', 'required' => 1])
    ->endRepeater();

$radio_group_default_field = (new FieldsBuilder('radio_group_default_fields'));
$radio_group_default_field->addText('default_value', ['label' => 'Default Selected Value']);

$radio_group_disabled_field = (new FieldsBuilder('radio_group_disabled_fields'));
$radio_group_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$radio_group_orientation_field = (new FieldsBuilder('radio_group_orientation_fields'));
$radio_group_orientation_field->addSelect('orientation', [
    'label'         => 'Orientation',
    'choices'       => [
        'vertical'   => 'Vertical',
        'horizontal' => 'Horizontal',
    ],
    'default_value' => 'vertical',
]);

$radio_group_full_fields = (new FieldsBuilder('radio_group_component_fields'));
$radio_group_full_fields
    ->addFields($radio_group_name_field)
    ->addFields($radio_group_label_field)
    ->addFields($radio_group_items_field)
    ->addFields($radio_group_default_field)
    ->addFields($radio_group_disabled_field)
    ->addFields($radio_group_orientation_field);

return [
    'name'          => $radio_group_name_field,
    'label'         => $radio_group_label_field,
    'options'       => $radio_group_items_field,
    'default_value' => $radio_group_default_field,
    'disabled'      => $radio_group_disabled_field,
    'orientation'   => $radio_group_orientation_field,
    'full'          => $radio_group_full_fields,
];
