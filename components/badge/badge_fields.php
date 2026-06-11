<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$badge_label_field = (new FieldsBuilder('badge_label_fields'));
$badge_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$variant_choices = [
    'default'     => 'Default',
    'secondary'   => 'Secondary',
    'destructive' => 'Destructive',
    'outline'     => 'Outline',
];

$badge_variant_field = (new FieldsBuilder('badge_variant_fields'));
$badge_variant_field->addSelect('variant', [
    'label'         => 'Variant',
    'choices'       => $variant_choices,
    'default_value' => 'default',
]);

$badge_full_fields = (new FieldsBuilder('badge_component_fields'));
$badge_full_fields
    ->addFields($badge_label_field)
    ->addFields($badge_variant_field);

return [
    'label'           => $badge_label_field,
    'variant'         => $badge_variant_field,
    'variant_choices' => $variant_choices,
    'full'            => $badge_full_fields,
];
