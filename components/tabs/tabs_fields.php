<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$tabs_items_field = (new FieldsBuilder('tabs_items_fields'));
$tabs_items_field
    ->addRepeater('tabs', ['label' => 'Tabs', 'min' => 1, 'layout' => 'block'])
        ->addText('label', ['label' => 'Tab Label', 'required' => 1])
        ->addWysiwyg('content', ['label' => 'Content', 'media_upload' => 0])
    ->endRepeater();

$tabs_full_fields = (new FieldsBuilder('tabs_component_fields'));
$tabs_full_fields->addFields($tabs_items_field);

return [
    'tabs'  => $tabs_items_field,
    'full'  => $tabs_full_fields,
];
