<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$tabs_items_field = (new FieldsBuilder('tabs_items_fields'));
$repeater = $tabs_items_field
    ->addRepeater('tabs', ['label' => 'Tabs', 'min' => 1, 'layout' => 'block'])
        ->addText('label', ['label' => 'Tab Label', 'required' => 1])
        ->addWysiwyg('content', ['label' => 'Content', 'media_upload' => 0]);

$providers = apply_filters('theme/icon_providers', []);
if (!empty($providers)) {
    $is_multi = count($providers) > 1;
    $repeater->addTrueFalse('include_icon', ['label' => 'Include Icon', 'default_value' => 0, 'ui' => true]);
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

$tabs_full_fields = (new FieldsBuilder('tabs_component_fields'));
$tabs_full_fields->addFields($tabs_items_field);

return [
    'tabs'  => $tabs_items_field,
    'full'  => $tabs_full_fields,
];
