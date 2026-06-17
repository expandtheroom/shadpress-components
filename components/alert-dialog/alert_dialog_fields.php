<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$alert_dialog_trigger_field = (new FieldsBuilder('alert_dialog_trigger_fields'));
$alert_dialog_trigger_field->addText('trigger_label', [
    'label'    => 'Trigger Label',
    'required' => 1,
]);

$alert_dialog_title_field = (new FieldsBuilder('alert_dialog_title_fields'));
$alert_dialog_title_field->addText('title', [
    'label'    => 'Dialog Title',
    'required' => 1,
]);

$alert_dialog_description_field = (new FieldsBuilder('alert_dialog_description_fields'));
$alert_dialog_description_field->addTextarea('description', [
    'label' => 'Description',
    'rows'  => 3,
]);

$alert_dialog_cancel_field = (new FieldsBuilder('alert_dialog_cancel_fields'));
$alert_dialog_cancel_field->addText('cancel_label', [
    'label'         => 'Cancel Button Label',
    'default_value' => 'Cancel',
]);

$alert_dialog_confirm_field = (new FieldsBuilder('alert_dialog_confirm_fields'));
$alert_dialog_confirm_field->addText('confirm_label', [
    'label'         => 'Confirm Button Label',
    'default_value' => 'Continue',
]);

// Import variant choices from Button, filtered to the two meaningful confirm actions.
$button_fields = require get_stylesheet_directory() . '/components/button/button_fields.php';
$variant_choices = array_intersect_key(
    $button_fields['variant_choices'],
    array_flip(['default', 'destructive'])
);

$alert_dialog_variant_field = (new FieldsBuilder('alert_dialog_variant_fields'));
$alert_dialog_variant_field->addSelect('variant', [
    'label'         => 'Confirm Button Variant',
    'choices'       => $variant_choices,
    'default_value' => 'default',
]);

$alert_dialog_full_fields = (new FieldsBuilder('alert_dialog_component_fields'));
$alert_dialog_full_fields
    ->addFields($alert_dialog_trigger_field)
    ->addFields($alert_dialog_title_field)
    ->addFields($alert_dialog_description_field)
    ->addFields($alert_dialog_cancel_field)
    ->addFields($alert_dialog_confirm_field)
    ->addFields($alert_dialog_variant_field);

return [
    'trigger_label'   => $alert_dialog_trigger_field,
    'title'           => $alert_dialog_title_field,
    'description'     => $alert_dialog_description_field,
    'cancel_label'    => $alert_dialog_cancel_field,
    'confirm_label'   => $alert_dialog_confirm_field,
    'variant'         => $alert_dialog_variant_field,
    'variant_choices' => $variant_choices,
    'full'            => $alert_dialog_full_fields,
];
