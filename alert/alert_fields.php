<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$alert_title_field = (new FieldsBuilder('alert_title_fields'));
$alert_title_field->addText('title', ['label' => 'Title']);

$alert_description_field = (new FieldsBuilder('alert_description_fields'));
$alert_description_field->addTextarea('description', [
    'label' => 'Description',
    'required' => 1,
    'rows' => 3,
]);

$variant_choices = [
    'default' => 'Default',
    'destructive' => 'Destructive',
];

$alert_variant_field = (new FieldsBuilder('alert_variant_fields'));
$alert_variant_field->addSelect('variant', [
    'label' => 'Variant',
    'choices' => $variant_choices,
    'default_value' => 'default',
]);

$alert_dismissible_field = (new FieldsBuilder('alert_dismissible_fields'));
$alert_dismissible_field->addTrueFalse('dismissible', [
    'label' => 'Dismissible',
    'default_value' => 0,
    'ui' => 1,
]);

$alert_full_fields = (new FieldsBuilder('alert_component_fields'));
$alert_full_fields
    ->addFields($alert_title_field)
    ->addFields($alert_description_field)
    ->addFields($alert_variant_field)
    ->addFields($alert_dismissible_field);

return [
    'title' => $alert_title_field,
    'description' => $alert_description_field,
    'variant' => $alert_variant_field,
    'variant_choices' => $variant_choices,
    'dismissible' => $alert_dismissible_field,
    'full' => $alert_full_fields,
];
