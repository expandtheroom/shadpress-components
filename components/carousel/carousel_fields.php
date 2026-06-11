<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$carousel_items_field = (new FieldsBuilder('carousel_items_fields'));
$carousel_items_field
    ->addRepeater('slides', [
        'label'  => 'Slides',
        'min'    => 1,
        'layout' => 'block',
    ])
        ->addImage('image', [
            'label'         => 'Image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ])
        ->addText('title', ['label' => 'Title'])
        ->addTextarea('description', [
            'label' => 'Description',
            'rows'  => 2,
        ])
    ->endRepeater();

$carousel_options_field = (new FieldsBuilder('carousel_options_fields'));
$carousel_options_field
    ->addTrueFalse('loop', [
        'label'         => 'Loop',
        'ui'            => 1,
        'default_value' => 0,
    ])
    ->addTrueFalse('autoplay', [
        'label'         => 'Auto-play',
        'ui'            => 1,
        'default_value' => 0,
    ])
    ->addNumber('autoplay_delay', [
        'label'         => 'Auto-play Delay (ms)',
        'default_value' => 3000,
        'min'           => 500,
        'step'          => 100,
    ])
    ->conditional('autoplay', '==', '1');

$carousel_full_fields = (new FieldsBuilder('carousel_component_fields'));
$carousel_full_fields
    ->addFields($carousel_items_field)
    ->addFields($carousel_options_field);

return [
    'slides'  => $carousel_items_field,
    'options' => $carousel_options_field,
    'full'    => $carousel_full_fields,
];
