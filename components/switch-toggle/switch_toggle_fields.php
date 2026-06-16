<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$cbf_fields = require(get_stylesheet_directory() . '/components/checkbox-field/checkbox_field_fields.php');

$switch_toggle_full_fields = (new FieldsBuilder('switch_toggle_component_fields'));
$switch_toggle_full_fields
    ->addFields($cbf_fields['label'])
    ->addFields($cbf_fields['name'])
    ->addFields($cbf_fields['checked'])
    ->addFields($cbf_fields['disabled']);

return [
    'label'    => $cbf_fields['label'],
    'name'     => $cbf_fields['name'],
    'checked'  => $cbf_fields['checked'],
    'disabled' => $cbf_fields['disabled'],
    'full'     => $switch_toggle_full_fields,
];
