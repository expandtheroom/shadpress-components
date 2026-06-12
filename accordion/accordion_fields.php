<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$type_choices = [
    'single'   => 'Single (one open at a time)',
    'multiple' => 'Multiple',
];

$accordion_type_field = (new FieldsBuilder('accordion_type_fields'));
$accordion_type_field->addSelect('type', [
    'label'         => 'Type',
    'choices'       => $type_choices,
    'default_value' => 'single',
]);

$accordion_items_field = (new FieldsBuilder('accordion_items_fields'));
$repeater = $accordion_items_field
    ->addRepeater('panels', ['label' => 'Panels', 'min' => 1, 'layout' => 'block'])
    ->addText('trigger', ['label' => 'Heading', 'required' => 1])
    ->addWysiwyg('content', ['label' => 'Content', 'media_upload' => 0]);

$providers = apply_filters('theme/icon_providers', []);
if (!empty($providers)) {
    $is_multi = count($providers) > 1;
    foreach ($providers as $key => $provider) {
        $field_name = 'icon_' . str_replace('-', '_', $key);
        $repeater->addField($field_name, $provider['field_type'], $provider['field_args']);
        $icon_field = $repeater->getField($field_name);
        if ($is_multi) {
            $icon_field->conditional('include_icon', '==', '1')->and('icon_provider', '==', $key);
        } else {
            $icon_field->conditional('include_icon', '==', '1');
        }
    }
}

$repeater->endRepeater();

$accordion_full_fields = (new FieldsBuilder('accordion_component_fields'));
$accordion_full_fields
    ->addFields($accordion_type_field)
    ->addFields($accordion_items_field);

return [
    'type'         => $accordion_type_field,
    'type_choices' => $type_choices,
    'panels'       => $accordion_items_field,
    'full'         => $accordion_full_fields,
];
