<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$orientation_choices = [
    'horizontal' => 'Horizontal',
    'vertical'   => 'Vertical',
];
$separator_orientation_field = (new FieldsBuilder('separator_orientation_fields'));
$separator_orientation_field->addSelect('orientation', [
    'label'         => 'Orientation',
    'choices'       => $orientation_choices,
    'default_value' => 'horizontal',
]);

$separator_decorative_field = (new FieldsBuilder('separator_decorative_fields'));
$separator_decorative_field->addTrueFalse('decorative', [
    'label'         => 'Decorative',
    'ui'            => 1,
    'default_value' => 1,
]);

$separator_full_fields = (new FieldsBuilder('separator_component_fields'));
$separator_full_fields
    ->addFields($separator_orientation_field)
    ->addFields($separator_decorative_field);

return [
    'orientation'         => $separator_orientation_field,
    'orientation_choices' => $orientation_choices,
    'decorative'          => $separator_decorative_field,
    'full'                => $separator_full_fields,
];
