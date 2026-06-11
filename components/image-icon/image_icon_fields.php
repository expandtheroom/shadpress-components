<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$image_icon_icon_field = (new FieldsBuilder('image_icon_icon_fields'));
$image_icon_icon_field->addField('icon', 'icon_picker', [
    'label' => 'Icon',
    'tabs' => ['media_library', 'url'],
]);

$image_icon_full_fields = (new FieldsBuilder('image_icon_component_fields'));
$image_icon_full_fields->addFields($image_icon_icon_field);

return [
    'icon' => $image_icon_icon_field,
    'full' => $image_icon_full_fields,
];
