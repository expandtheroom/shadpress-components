<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$menubar_label_field = (new FieldsBuilder('menubar_label_fields'));
$menubar_label_field->addText('label', [
    'label' => 'Label (Accessible Name)',
]);

$menubar_menus_field = (new FieldsBuilder('menubar_menus_fields'));
$menubar_menus_field
    ->addRepeater('menus', [
        'label'  => 'Menus',
        'min'    => 1,
        'layout' => 'block',
    ])
        ->addText('label', [
            'label'    => 'Menu Label',
            'required' => 1,
        ])
        ->addRepeater('menu_items', [
            'label'  => 'Menu Items',
            'layout' => 'table',
        ])
            ->addText('label', [
                'label' => 'Label',
            ])
            ->addUrl('href', [
                'label' => 'URL (optional)',
            ])
            ->addSelect('type', [
                'label'         => 'Type',
                'choices'       => [
                    'item'      => 'Item',
                    'separator' => 'Separator',
                    'label'     => 'Label (heading)',
                ],
                'default_value' => 'item',
            ])
        ->endRepeater()
    ->endRepeater();

$menubar_full_fields = (new FieldsBuilder('menubar_component_fields'));
$menubar_full_fields
    ->addFields($menubar_label_field)
    ->addFields($menubar_menus_field);

return [
    'label' => $menubar_label_field,
    'menus' => $menubar_menus_field,
    'full'  => $menubar_full_fields,
];
