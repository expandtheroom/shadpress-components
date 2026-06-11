<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

// Reuse button choices so button-group stays in sync with Button variants/sizes
$button_fields = require get_stylesheet_directory() . '/components/button/button_fields.php';
$variant_choices = $button_fields['variant_choices'];
$size_choices    = $button_fields['size_choices'];

$orientation_choices = [
    'horizontal' => 'Horizontal',
    'vertical'   => 'Vertical',
];
$button_group_orientation_field = (new FieldsBuilder('button_group_orientation_fields'));
$button_group_orientation_field->addSelect('orientation', [
    'label'         => 'Orientation',
    'choices'       => $orientation_choices,
    'default_value' => 'horizontal',
]);

$spacing_choices = [
    'conjoined' => 'Conjoined',
    'xs'        => 'Extra Small',
    'sm'        => 'Small',
    'md'        => 'Medium',
    'lg'        => 'Large',
];
$button_group_spacing_field = (new FieldsBuilder('button_group_spacing_fields'));
$button_group_spacing_field->addSelect('spacing', [
    'label'         => 'Spacing',
    'choices'       => $spacing_choices,
    'default_value' => 'conjoined',
]);

// Size is shared across all buttons in the group
$button_group_size_field = (new FieldsBuilder('button_group_size_fields'));
$button_group_size_field->addSelect('size', [
    'label'         => 'Size',
    'choices'       => $size_choices,
    'default_value' => 'default',
]);

// Each button has its own link and variant; size comes from the group
$button_group_buttons_field = (new FieldsBuilder('button_group_buttons_fields'));
$button_group_buttons_field
    ->addRepeater('buttons', [
        'label'  => 'Buttons',
        'min'    => 1,
        'layout' => 'row',
    ])
        ->addLink('link', ['label' => 'Link'])
        ->addSelect('variant', [
            'label'         => 'Variant',
            'choices'       => $variant_choices,
            'default_value' => 'default',
        ])
    ->endRepeater();

// Assemble full field group
$button_group_full_fields = (new FieldsBuilder('button_group_component_fields'));
$button_group_full_fields
    ->addFields($button_group_orientation_field)
    ->addFields($button_group_spacing_field)
    ->addFields($button_group_size_field)
    ->addFields($button_group_buttons_field);

// Use like:
//   $button_group_fields = require get_stylesheet_directory() . '/components/button-group/button_group_fields.php';
//   $fields->addFields($button_group_fields['full']);
return [
    'orientation'         => $button_group_orientation_field,
    'orientation_choices' => $orientation_choices,
    'spacing'             => $button_group_spacing_field,
    'spacing_choices'     => $spacing_choices,
    'size'                => $button_group_size_field,
    'buttons'             => $button_group_buttons_field,
    'full'                => $button_group_full_fields,
];
