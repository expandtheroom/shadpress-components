<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$cbf_fields = require(get_stylesheet_directory() . '/components/checkbox-field/checkbox_field_fields.php');

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

$toggle_full_fields = (new FieldsBuilder('toggle_component_fields'));
$toggle_full_fields
    ->addFields($cbf_fields['label'])
    ->addFields($cbf_fields['checked'])
    ->addFields($cbf_fields['disabled'])
    ->addFields($toggle_variant_field)
    ->addFields($toggle_size_field)
;

return [
    'checked'  => $cbf_fields['checked'],
    'disabled' => $cbf_fields['disabled'],
    'label'    => $cbf_fields['label'],
    'variant'  => $toggle_variant_field,
    'size'     => $toggle_size_field,
    'full'     => $toggle_full_fields,
];
