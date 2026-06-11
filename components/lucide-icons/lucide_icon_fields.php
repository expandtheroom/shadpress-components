<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (array $config = []): array {
    $include = $config['include'] ?? [];
    $ignore = $config['ignore'] ?? [];

    $icon_name_field = (new FieldsBuilder('icon_name_fields'));
    $icon_name_field->addField('icon_name', 'theme_icon_picker', [
        'label' => 'Lucide Icon',
        'required' => 1,
        'include' => $include,
        'ignore' => $ignore,
        'instructions' => 'Select an icon from the Lucide icon set. There are A LOT of icons, so the select takes a moment to load. Click once, be patient.',
    ]);

    $icon_full_fields = (new FieldsBuilder('icon_component_fields'));
    $icon_full_fields->addFields($icon_name_field);

    return [
        'icon_name' => $icon_name_field,
        'full' => $icon_full_fields,
    ];
};
