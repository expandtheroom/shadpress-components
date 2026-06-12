<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$card_title_field = (new FieldsBuilder('card_title_fields'));
$card_title_field->addText('title', ['label' => 'Title', 'required' => 1]);

$card_description_field = (new FieldsBuilder('card_description_fields'));
$card_description_field->addTextarea('description', ['label' => 'Description', 'rows' => 2]);

$card_image_field = (new FieldsBuilder('card_image_fields'));
$card_image_field->addImage('image', [
    'label'         => 'Image',
    'return_format' => 'array',
    'preview_size'  => 'medium',
]);

$card_content_field = (new FieldsBuilder('card_content_fields'));
$card_content_field->addWysiwyg('card_content', ['label' => 'Content', 'media_upload' => 0]);

$card_link_field = (new FieldsBuilder('card_link_fields'));
$card_link_field->addLink('link', ['label' => 'Link']);

$card_badge_field = (new FieldsBuilder('card_badge_fields'));
$card_badge_field->addText('badge', ['label' => 'Badge Label']);

$card_full_fields = (new FieldsBuilder('card_component_fields'));
$card_full_fields
    ->addFields($card_title_field)
    ->addFields($card_description_field)
    ->addFields($card_image_field)
    ->addFields($card_content_field)
    ->addFields($card_link_field)
    ->addFields($card_badge_field);

return [
    'title'       => $card_title_field,
    'description' => $card_description_field,
    'image'       => $card_image_field,
    'content'     => $card_content_field,
    'link'        => $card_link_field,
    'badge'       => $card_badge_field,
    'full'        => $card_full_fields,
];
