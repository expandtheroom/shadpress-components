<?php
// Create 1 FieldsBuilder for each field or directly relates set of fields.
$button_link_field = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_link_fields'));
$button_link_field->addLink('link', ['label' => 'Link']);

$button_label_field = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_label_fields'));
$button_label_field->addText('label', ['label' => 'Label']);

// Static select field choices are defined separately so they can be exported for use in other components.
$variant_choices = [
    'default' => 'Default',
    'secondary' => 'Secondary',
    'outline' => 'Outline',
    'ghost' => 'Ghost',
    'link' => 'Link',
    'destructive' => 'Destructive',
];
$button_variant_field = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_variant_fields'));
$button_variant_field->addSelect('variant', [
    'label' => 'Variant',
    'choices' => $variant_choices,
    'default_value' => 'default',
]);

$size_choices = [
    'xs' => 'Extra Small',
    'sm' => 'Small',
    'default' => 'Default',
    'lg' => 'Large',
    'icon' => 'Icon',
    'icon-xs' => 'Icon XS',
    'icon-sm' => 'Icon Small',
    'icon-lg' => 'Icon Large',
];
$button_size_field = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_size_fields'));
$button_size_field->addSelect('size', [
    'label' => 'Size',
    'choices' => $size_choices,
    'default_value' => 'default',
]);

$type_choices = [
    'button' => 'Button',
    'submit' => 'Submit',
    'reset' => 'Reset',
];
$button_type_field = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_type_fields'));
$button_type_field->addSelect('type', [
    'label' => 'Button Type',
    'choices' => $type_choices,
    'default_value' => 'button',
]);

$click_action_choices = [
    'none' => 'None',
    'alpine' => 'Alpine Module',
];
$button_click_action_field = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_click_action_fields'));
$button_click_action_field->addSelect('click_action', [
    'label' => 'Click Action',
    'choices' => $click_action_choices,
    'default_value' => 'none',
]);

$button_alpine_module_field = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_alpine_module_fields'));
$button_alpine_module_field->addSelect('alpine_module', ['label' => 'Alpine Module', 'choices' => ['' => 'Select Module'], 'default_value' => '']);

$button_disabled_field = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_disabled_fields'));
$button_disabled_field->addTrueFalse('disabled', ['label' => 'Disabled', 'default_value' => 0]);

// Assemble the full set of fields for use directly by the button component
$button_full_fields = (new \StoutLogic\AcfBuilder\FieldsBuilder('button_component_fields'));
$button_full_fields->addRadio('button_component', [
    'label' => 'Button Component',
    'choices' => [
        'button' => 'Button',
        'link' => 'Link'
    ],
    'default_value' => 'link',
])
    ->addFields($button_link_field)
    ->addFields($button_label_field)
    ->addFields($button_variant_field)
    ->addFields($button_size_field)
    ->addFields($button_type_field)
    ->addFields($button_click_action_field)
    ->addFields($button_alpine_module_field)
    ->addFields($button_disabled_field);

// Set up conditional logic for the full field group to show/hide fields based on other field values.
$button_full_fields->getField('link')->conditional('button_component', '==', 'link');
$button_full_fields->getField('label')->conditional('button_component', '==', 'button');
$button_full_fields->getField('type')->conditional('button_component', '==', 'button');
$button_full_fields->getField('click_action')->conditional('button_component', '==', 'button');
$button_full_fields->getField('alpine_module')->conditional('click_action', '==', 'alpine');
$button_full_fields->getField('disabled')->conditional('button_component', '==', 'button');

// Return an array of all the individual fields and choices and the full field group for use in the button component and elsewhere as needed.
// Use like:
//       // Import the full field set
//       $button_fields = require(get_stylesheet_directory() . '/components/button/button_fields.php');
//       $fields->addFields($button_fields['full']);
//
//       // Import individual fields and choices as needed
//       $button_fields = require(get_stylesheet_directory() . '/components/button/button_fields.php');
//       $fields->addFields($button_fields['label'])
//          ->addFields($button_fields['variant'])
//          ->addFields($button_fields['size']);
//
//       // Add conditional logic to individual fields as needed
//       $fields->getField('size')->conditional('variant', '!=', 'link');
return [
    'alpine_module' => $button_alpine_module_field,
    'click_action' => $button_click_action_field,
    'disabled' => $button_disabled_field,
    'full' => $button_full_fields,
    'label' => $button_label_field,
    'link' => $button_link_field,
    'size' => $button_size_field,
    'size_choices' => $size_choices,
    'type' => $button_type_field,
    'type_choices' => $type_choices,
    'variant' => $button_variant_field,
    'variant_choices' => $variant_choices,
];
