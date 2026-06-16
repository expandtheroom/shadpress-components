<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$toggle_group_type_field = (new FieldsBuilder('toggle_group_type_fields'));
$toggle_group_type_field->addSelect('type', [
    'label' => 'Selection Type',
    'choices' => [
        'single' => 'Single',
        'multiple' => 'Multiple',
    ],
    'default_value' => 'single',
]);

$toggle_group_items_field = (new FieldsBuilder('toggle_group_items_fields'));
$toggle_group_items_field
    ->addRepeater('toggles', ['label' => 'Toggles', 'min' => 1, 'layout' => 'table'])
    ->addText('label', ['label' => 'Label', 'required' => 1])
    ->addText('value', ['label' => 'Value', 'required' => 1])
    ->endRepeater();

$toggle_group_default_field = (new FieldsBuilder('toggle_group_default_fields'));
$toggle_group_default_field->addText('default_value', [
    'label' => 'Default Value(s)',
    'instructions' => 'For multiple: comma-separated values.',
]);

$toggle_group_label_field = (new FieldsBuilder('toggle_group_label_fields'));
$toggle_group_label_field->addText('label', ['label' => 'Label (Accessible Name)']);

$toggle_group_full_fields = (new FieldsBuilder('toggle_group_component_fields'));
$toggle_group_full_fields
    ->addFields($toggle_group_label_field)
    ->addFields($toggle_group_type_field)
    ->addFields($toggle_group_items_field)
    ->addFields($toggle_group_default_field);

return [
    'label' => $toggle_group_label_field,
    'type' => $toggle_group_type_field,
    'toggles' => $toggle_group_items_field,
    'default_value' => $toggle_group_default_field,
    'full' => $toggle_group_full_fields,
];
