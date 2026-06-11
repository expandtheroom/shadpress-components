<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$input_fields         = require(get_stylesheet_directory() . '/components/input-field/input_field_fields.php');
$textarea_fields      = require(get_stylesheet_directory() . '/components/textarea-field/textarea_field_fields.php');
$native_select_fields = require(get_stylesheet_directory() . '/components/native-select-field/native_select_field_fields.php');
$checkbox_fields      = require(get_stylesheet_directory() . '/components/checkbox-field/checkbox_field_fields.php');

$stf_label_field = (new FieldsBuilder('stf_label_fields'));
$stf_label_field->addText('label', ['label' => 'Label', 'required' => 1]);

$stf_description_field = (new FieldsBuilder('stf_description_fields'));
$stf_description_field->addText('description', ['label' => 'Helper Description']);

$stf_required_field = (new FieldsBuilder('stf_required_fields'));
$stf_required_field->addTrueFalse('required', [
    'label'         => 'Required',
    'ui'            => 1,
    'default_value' => 0,
]);

$stf_error_field = (new FieldsBuilder('stf_error_fields'));
$stf_error_field->addText('error', [
    'label'        => 'Error Message',
    'instructions' => 'Leave blank for no error state.',
]);

$stf_name_field = (new FieldsBuilder('stf_name_fields'));
$stf_name_field->addText('name', ['label' => 'Name (HTML)']);

$stf_checked_field = (new FieldsBuilder('stf_checked_fields'));
$stf_checked_field->addTrueFalse('checked', [
    'label'         => 'Initially On',
    'ui'            => 1,
    'default_value' => 0,
]);

$stf_full_fields = (new FieldsBuilder('switch_toggle_field_component_fields'));
$stf_full_fields
    ->addFields($stf_label_field)
    ->addFields($stf_description_field)
    ->addFields($stf_required_field)
    ->addFields($stf_error_field)
    ->addFields($stf_name_field)
    ->addFields($stf_checked_field);

$field_full_fields = (new FieldsBuilder('field_component_fields'));
$field_full_fields
    ->addSelect('control_type', [
        'label'         => 'Field Type',
        'choices'       => [
            'input'         => 'Input',
            'textarea'      => 'Textarea',
            'native-select' => 'Select',
            'checkbox'      => 'Checkbox',
            'switch-toggle' => 'Switch Toggle',
        ],
        'default_value' => 'input',
    ])
    ->addGroup('input_fields', [
        'label'  => '',
        'layout' => 'block',
        'conditional_logic' => [[
            ['field' => 'control_type', 'operator' => '==', 'value' => 'input'],
        ]],
    ])
    ->addFields($input_fields['full'])
    ->endGroup()
    ->addGroup('textarea_fields', [
        'label'  => '',
        'layout' => 'block',
        'conditional_logic' => [[
            ['field' => 'control_type', 'operator' => '==', 'value' => 'textarea'],
        ]],
    ])
    ->addFields($textarea_fields['full'])
    ->endGroup()
    ->addGroup('native_select_fields', [
        'label'  => '',
        'layout' => 'block',
        'conditional_logic' => [[
            ['field' => 'control_type', 'operator' => '==', 'value' => 'native-select'],
        ]],
    ])
    ->addFields($native_select_fields['full'])
    ->endGroup()
    ->addGroup('checkbox_fields', [
        'label'  => '',
        'layout' => 'block',
        'conditional_logic' => [[
            ['field' => 'control_type', 'operator' => '==', 'value' => 'checkbox'],
        ]],
    ])
    ->addFields($checkbox_fields['full'])
    ->endGroup()
    ->addGroup('switch_toggle_fields', [
        'label'  => '',
        'layout' => 'block',
        'conditional_logic' => [[
            ['field' => 'control_type', 'operator' => '==', 'value' => 'switch-toggle'],
        ]],
    ])
    ->addFields($stf_full_fields)
    ->endGroup();

return [
    'full' => $field_full_fields,
];
