<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$dropdown_menu_trigger_label_field = (new FieldsBuilder('dropdown_menu_trigger_label_fields'));
$dropdown_menu_trigger_label_field->addText('trigger_label', [
    'label'    => 'Trigger Label',
    'required' => 1,
]);

$dropdown_menu_trigger_variant_field = (new FieldsBuilder('dropdown_menu_trigger_variant_fields'));
$dropdown_menu_trigger_variant_field->addSelect('trigger_variant', [
    'label'         => 'Trigger Variant',
    'choices'       => [
        'default'   => 'Default',
        'outline'   => 'Outline',
        'secondary' => 'Secondary',
        'ghost'     => 'Ghost',
    ],
    'default_value' => 'default',
]);

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
            'choices'       => [
                'item'      => 'Item',
                'separator' => 'Separator',
                'label'     => 'Label (heading)',
            ],
            'default_value' => 'item',
        ])
    ->endRepeater();

$dropdown_menu_full_fields = (new FieldsBuilder('dropdown_menu_component_fields'));
$dropdown_menu_full_fields
    ->addFields($dropdown_menu_trigger_label_field)
    ->addFields($dropdown_menu_trigger_variant_field)
    ->addFields($dropdown_menu_items_field);

return [
    'trigger_label'   => $dropdown_menu_trigger_label_field,
    'trigger_variant' => $dropdown_menu_trigger_variant_field,
    'menu_items'      => $dropdown_menu_items_field,
    'full'            => $dropdown_menu_full_fields,
];
