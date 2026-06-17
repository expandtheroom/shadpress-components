<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$toggle_group_label_field = (new FieldsBuilder('toggle_group_label_fields'));
$toggle_group_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$toggle_group_description_field = (new FieldsBuilder('toggle_group_description_fields'));
$toggle_group_description_field->addText('description', ['label' => 'Helper Description']);

$toggle_group_required_field = (new FieldsBuilder('toggle_group_required_fields'));
$toggle_group_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$toggle_group_error_field = (new FieldsBuilder('toggle_group_error_fields'));
$toggle_group_error_field->addText('error', [
    'label'        => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$toggle_group_options_field = (new FieldsBuilder('toggle_group_options_fields'));
$toggle_group_options_field
    ->addRepeater('options', ['label' => 'Options', 'min' => 1, 'layout' => 'table'])
    ->addText('label', ['label' => 'Label'])
    ->addText('value', ['label' => 'Value', 'required' => 1])
    ->addTrueFalse('checked', [
        'label'         => 'Checked by Default',
        'ui'            => 1,
        'default_value' => 0,
    ])
    ->endRepeater();

$orientation_choices = [
    'horizontal' => 'Horizontal',
    'vertical'   => 'Vertical',
];
$toggle_group_orientation_field = (new FieldsBuilder('toggle_group_orientation_fields'));
$toggle_group_orientation_field->addSelect('orientation', [
    'label'         => 'Orientation',
    'choices'       => $orientation_choices,
    'default_value' => 'horizontal',
]);

$layout_choices = [
    'conjoined' => 'Conjoined',
    'separate'  => 'Separate',
];
$toggle_group_layout_field = (new FieldsBuilder('toggle_group_layout_fields'));
$toggle_group_layout_field->addSelect('layout', [
    'label'         => 'Layout',
    'choices'       => $layout_choices,
    'default_value' => 'conjoined',
]);

$toggle_group_multiple_field = (new FieldsBuilder('toggle_group_multiple_fields'));
$toggle_group_multiple_field->addTrueFalse('multiple', [
    'label'         => 'Multiple Selection',
    'instructions'  => 'Allow multiple options to be selected at once.',
    'ui'            => 1,
    'default_value' => 1,
]);

// Import variant and size from Toggle — Toggle is the single source of truth for toggle variant/size choices.
$toggle_fields = require get_stylesheet_directory() . '/components/toggle/toggle_fields.php';
$toggle_group_variant_field = $toggle_fields['variant'];

$toggle_group_size_field = (new FieldsBuilder('toggle_group_size_fields'));
$toggle_group_size_field->addSelect('size', [
    'label'         => 'Size',
    'choices'       => $toggle_fields['size_choices'],
    'default_value' => 'default',
]);

$toggle_group_full_fields = (new FieldsBuilder('toggle_group_component_fields'));
$toggle_group_full_fields
    ->addFields($toggle_group_label_field)
    ->addFields($toggle_group_description_field)
    ->addFields($toggle_group_required_field)
    ->addFields($toggle_group_error_field)
    ->addFields($toggle_group_options_field)
    ->addFields($toggle_group_orientation_field)
    ->addFields($toggle_group_layout_field)
    ->addFields($toggle_group_multiple_field)
    ->addFields($toggle_group_variant_field)
    ->addFields($toggle_group_size_field);

return [
    'label'               => $toggle_group_label_field,
    'description'         => $toggle_group_description_field,
    'required'            => $toggle_group_required_field,
    'error'               => $toggle_group_error_field,
    'options'             => $toggle_group_options_field,
    'orientation'         => $toggle_group_orientation_field,
    'orientation_choices' => $orientation_choices,
    'layout'              => $toggle_group_layout_field,
    'layout_choices'      => $layout_choices,
    'multiple'            => $toggle_group_multiple_field,
    'variant'             => $toggle_group_variant_field,
    'size'                => $toggle_group_size_field,
    'full'                => $toggle_group_full_fields,
];
