<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$toggle_label_field = (new FieldsBuilder('toggle_label_fields'));
$toggle_label_field->addText('label', [
    'label'    => 'Label',
    'required' => 1,
]);

$toggle_pressed_field = (new FieldsBuilder('toggle_pressed_fields'));
$toggle_pressed_field->addTrueFalse('pressed', [
    'label'         => 'Pressed by default',
    'ui'            => 1,
    'default_value' => 0,
]);

$toggle_variant_field = (new FieldsBuilder('toggle_variant_fields'));
$toggle_variant_field->addSelect('variant', [
    'label'         => 'Variant',
    'choices'       => [
        'default' => 'Default',
        'outline' => 'Outline',
    ],
    'default_value' => 'default',
]);

$toggle_size_field = (new FieldsBuilder('toggle_size_fields'));
$toggle_size_field->addSelect('size', [
    'label'         => 'Size',
    'choices'       => [
        'default' => 'Default',
        'sm'      => 'Small',
        'lg'      => 'Large',
    ],
    'default_value' => 'default',
]);

$toggle_disabled_field = (new FieldsBuilder('toggle_disabled_fields'));
$toggle_disabled_field->addTrueFalse('disabled', [
    'label'         => 'Disabled',
    'ui'            => 1,
    'default_value' => 0,
]);

$toggle_full_fields = (new FieldsBuilder('toggle_component_fields'));
$toggle_full_fields
    ->addFields($toggle_label_field)
    ->addFields($toggle_pressed_field)
    ->addFields($toggle_variant_field)
    ->addFields($toggle_size_field)
    ->addFields($toggle_disabled_field);

return [
    'label'    => $toggle_label_field,
    'pressed'  => $toggle_pressed_field,
    'variant'  => $toggle_variant_field,
    'size'     => $toggle_size_field,
    'disabled' => $toggle_disabled_field,
    'full'     => $toggle_full_fields,
];
