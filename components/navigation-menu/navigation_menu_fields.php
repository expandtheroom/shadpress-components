<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$nav_locations = function_exists('get_registered_nav_menus') ? get_registered_nav_menus() : [];
$nav_choices   = [];
foreach ($nav_locations as $location => $description) {
    $nav_choices[$location] = $description;
}

$navigation_menu_location_field = (new FieldsBuilder('navigation_menu_location_fields'));
$navigation_menu_location_field->addSelect('menu_location', [
    'label'        => 'Menu Location',
    'choices'      => $nav_choices,
    'instructions' => 'Select a registered WordPress nav menu location.',
]);

$navigation_menu_orientation_field = (new FieldsBuilder('navigation_menu_orientation_fields'));
$navigation_menu_orientation_field->addSelect('orientation', [
    'label'         => 'Orientation',
    'choices'       => [
        'horizontal' => 'Horizontal',
        'vertical'   => 'Vertical',
    ],
    'default_value' => 'horizontal',
]);

$navigation_menu_full_fields = (new FieldsBuilder('navigation_menu_component_fields'));
$navigation_menu_full_fields
    ->addFields($navigation_menu_location_field)
    ->addFields($navigation_menu_orientation_field);

return [
    'menu_location' => $navigation_menu_location_field,
    'orientation'   => $navigation_menu_orientation_field,
    'full'          => $navigation_menu_full_fields,
];
