<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$scroll_area_content_field = (new FieldsBuilder('scroll_area_content_fields'));
$scroll_area_content_field->addWysiwyg('body', [
    'label'        => 'Content',
    'media_upload' => 0,
]);

$scroll_area_max_height_field = (new FieldsBuilder('scroll_area_max_height_fields'));
$scroll_area_max_height_field->addText('max_height', [
    'label'         => 'Max Height',
    'default_value' => '300px',
    'instructions'  => 'CSS value, e.g. 300px, 50vh, 20rem.',
]);

$scroll_area_orientation_field = (new FieldsBuilder('scroll_area_orientation_fields'));
$scroll_area_orientation_field->addSelect('orientation', [
    'label'         => 'Scroll Direction',
    'choices'       => [
        'vertical'   => 'Vertical',
        'horizontal' => 'Horizontal',
        'both'       => 'Both',
    ],
    'default_value' => 'vertical',
]);

$scroll_area_full_fields = (new FieldsBuilder('scroll_area_component_fields'));
$scroll_area_full_fields
    ->addFields($scroll_area_content_field)
    ->addFields($scroll_area_max_height_field)
    ->addFields($scroll_area_orientation_field);

return [
    'body'        => $scroll_area_content_field,
    'max_height'  => $scroll_area_max_height_field,
    'orientation' => $scroll_area_orientation_field,
    'full'        => $scroll_area_full_fields,
];
