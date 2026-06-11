<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$typography_content_field = (new FieldsBuilder('typography_content_fields'));
$typography_content_field->addWysiwyg('body', [
    'label'        => 'Content',
    'required'     => 1,
    'media_upload' => 0,
]);

$typography_variant_choices = [
    'default' => 'Default',
    'lead'    => 'Lead',
    'large'   => 'Large',
    'small'   => 'Small',
    'muted'   => 'Muted',
];

$typography_variant_field = (new FieldsBuilder('typography_variant_fields'));
$typography_variant_field->addSelect('variant', [
    'label'         => 'Variant',
    'choices'       => $typography_variant_choices,
    'default_value' => 'default',
]);

$typography_full_fields = (new FieldsBuilder('typography_component_fields'));
$typography_full_fields
    ->addFields($typography_content_field)
    ->addFields($typography_variant_field);

return [
    'body'    => $typography_content_field,
    'variant' => $typography_variant_field,
    'full'    => $typography_full_fields,
];
