<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$cbf_fields = require get_stylesheet_directory() . '/components/checkbox-field/checkbox_field_fields.php';

// Import variant and size from Button — single source of truth for variant/size choices.
$button_fields = require get_stylesheet_directory() . '/components/button/button_fields.php';
$variant_choices = $button_fields['variant_choices'];

// Filter out icon-* sizes; they don't make sense for text-label toggles.
$size_choices = array_filter(
    $button_fields['size_choices'],
    fn($key) => !str_starts_with($key, 'icon'),
    ARRAY_FILTER_USE_KEY
);

$toggle_variant_field = (new FieldsBuilder('toggle_variant_fields'));
$toggle_variant_field->addSelect('variant', [
    'label'         => 'Variant',
    'choices'       => $variant_choices,
    'default_value' => 'default',
]);

$toggle_size_field = (new FieldsBuilder('toggle_size_fields'));
$toggle_size_field->addSelect('size', [
    'label'         => 'Size',
    'choices'       => $size_choices,
    'default_value' => 'default',
]);

$toggle_full_fields = (new FieldsBuilder('toggle_component_fields'));
$toggle_full_fields
    ->addFields($cbf_fields['label'])
    ->addFields($cbf_fields['checked'])
    ->addFields($cbf_fields['disabled'])
    ->addFields($toggle_variant_field)
    ->addFields($toggle_size_field);

return [
    'checked'         => $cbf_fields['checked'],
    'disabled'        => $cbf_fields['disabled'],
    'label'           => $cbf_fields['label'],
    'variant'         => $toggle_variant_field,
    'variant_choices' => $variant_choices,
    'size'            => $toggle_size_field,
    'size_choices'    => $size_choices,
    'full'            => $toggle_full_fields,
];
