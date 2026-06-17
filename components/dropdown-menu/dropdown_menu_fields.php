<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$dropdown_menu_trigger_label_field = (new FieldsBuilder('dropdown_menu_trigger_label_fields'));
$dropdown_menu_trigger_label_field->addText('trigger_label', [
    'label'    => 'Trigger Label',
    'required' => 1,
]);

// Import variant choices from Button — single source of truth.
$button_fields = require get_stylesheet_directory() . '/components/button/button_fields.php';
$trigger_variant_choices = $button_fields['variant_choices'];

$dropdown_menu_trigger_variant_field = (new FieldsBuilder('dropdown_menu_trigger_variant_fields'));
$dropdown_menu_trigger_variant_field->addSelect('trigger_variant', [
    'label'         => 'Trigger Variant',
    'choices'       => $trigger_variant_choices,
    'default_value' => 'default',
]);

$item_type_choices = [
    'item'      => 'Item',
    'separator' => 'Separator',
    'label'     => 'Label (heading)',
];
$dropdown_menu_items_field = (new FieldsBuilder('dropdown_menu_items_fields'));
$dropdown_menu_items_field
    ->addRepeater('menu_items', [
        'label'  => 'Menu Items',
        'min'    => 1,
        'layout' => 'block',
    ])
        ->addText('label', [
            'label' => 'Label',
        ])
        ->addUrl('href', [
            'label' => 'URL (optional)',
        ])
        ->addSelect('type', [
            'label'         => 'Item Type',
            'choices'       => $item_type_choices,
            'default_value' => 'item',
        ])
    ->endRepeater();

$dropdown_menu_full_fields = (new FieldsBuilder('dropdown_menu_component_fields'));
$dropdown_menu_full_fields
    ->addFields($dropdown_menu_trigger_label_field)
    ->addFields($dropdown_menu_trigger_variant_field)
    ->addFields($dropdown_menu_items_field);

return [
    'trigger_label'          => $dropdown_menu_trigger_label_field,
    'trigger_variant'        => $dropdown_menu_trigger_variant_field,
    'trigger_variant_choices' => $trigger_variant_choices,
    'menu_items'             => $dropdown_menu_items_field,
    'item_type_choices'      => $item_type_choices,
    'full'                   => $dropdown_menu_full_fields,
];
