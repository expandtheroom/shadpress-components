<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$label_field = (new FieldsBuilder('field_label_fields'));
$label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$label_for_field = (new FieldsBuilder('field_label_for_fields'));
$label_for_field->addText('label_for', [
    'label' => 'For (input ID)',
    'instructions' => 'Links label to input via HTML for/id pair.',
]);

$description_field = (new FieldsBuilder('field_description_fields'));
$description_field->addText('description', ['label' => 'Helper Description']);

$required_field = (new FieldsBuilder('field_required_fields'));
$required_field->addTrueFalse('required', [
    'label' => 'Required',
    'ui' => 1,
    'default_value' => 0,
]);

$error_field = (new FieldsBuilder('field_error_fields'));
$error_field->addText('error', [
    'label' => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$type_choices = [
    'text' => 'Text',
    'email' => 'Email',
    'password' => 'Password',
    'number' => 'Number',
    'tel' => 'Telephone',
    'url' => 'URL',
    'search' => 'Search',
];
$type_field = (new FieldsBuilder('field_type_fields'));
$type_field->addSelect('field_type', [
    'label' => 'Input Type',
    'choices' => $type_choices,
    'default_value' => 'text',
]);

$name_field = (new FieldsBuilder('field_name_fields'));
$name_field->addText('name', ['label' => 'Name (HTML)']);

$placeholder_field = (new FieldsBuilder('field_placeholder_fields'));
$placeholder_field->addText('placeholder', ['label' => 'Placeholder']);

$prefix_field = (new FieldsBuilder('field_prefix_fields'));
$prefix_field->addText('prefix', [
    'label' => 'Prefix Addon',
    'instructions' => 'Optional text shown before the input (e.g. "$"). Renders the input-group style.',
]);

$suffix_field = (new FieldsBuilder('field_suffix_fields'));
$suffix_field->addText('suffix', [
    'label' => 'Suffix Addon',
    'instructions' => 'Optional text shown after the input (e.g. ".com"). Renders the input-group style.',
]);

$disabled_field = (new FieldsBuilder('field_disabled_fields'));
$disabled_field->addTrueFalse('disabled', [
    'label' => 'Disabled',
    'ui' => 1,
    'default_value' => 0,
]);

$full_fields = (new FieldsBuilder('field_component_fields'));
$full_fields
    ->addFields($label_field)
    ->addFields($label_for_field)
    ->addFields($description_field)
    ->addFields($required_field)
    ->addFields($error_field)
    ->addFields($type_field)
    ->addFields($name_field)
    ->addFields($placeholder_field)
    ->addFields($prefix_field)
    ->addFields($suffix_field)
    ->addFields($disabled_field);

return [
    'label' => $label_field,
    'label_for' => $label_for_field,
    'description' => $description_field,
    'required' => $required_field,
    'error' => $error_field,
    'field_type' => $type_field,
    'field_type_choices' => $type_choices,
    'name' => $name_field,
    'placeholder' => $placeholder_field,
    'prefix' => $prefix_field,
    'suffix' => $suffix_field,
    'disabled' => $disabled_field,
    'full' => $full_fields,
];
