<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$input_fields = require(get_stylesheet_directory() . '/components/input-field/input_field_fields.php');
$textarea_fields = require(get_stylesheet_directory() . '/components/textarea-field/textarea_field_fields.php');
$select_fields = require(get_stylesheet_directory() . '/components/select-field/select_field_fields.php');
$checkbox_fields = require(get_stylesheet_directory() . '/components/checkbox-field/checkbox_field_fields.php');
$checkbox_group_fields = require(get_stylesheet_directory() . '/components/checkbox-group-field/checkbox_group_field_fields.php');
$combobox_fields = require(get_stylesheet_directory() . '/components/combobox-field/combobox_fields.php');
$date_picker_fields = require(get_stylesheet_directory() . '/components/date-picker-field/date_picker_fields.php');
$radio_group_fields = require(get_stylesheet_directory() . '/components/radio-group-field/radio_group_field_fields.php');
$styled_select_fields = require(get_stylesheet_directory() . '/components/styled-select-field/styled_select_field_fields.php');
$toggle_group_fields = require(get_stylesheet_directory() . '/components/toggle-group/toggle_group_fields.php');

$field_full_fields = (new FieldsBuilder('form_field_component_fields'));
$field_full_fields
    ->addSelect('control_type', [
        'label' => 'Field Type',
        'choices' => [
            'checkbox' => 'Checkbox',
            'checkbox-group' => 'Checkbox Group',
            'combobox' => 'Combobox',
            'date-picker' => 'Date Picker',
            'input' => 'Input (text, email, etc.)',
            'radio-group' => 'Radio Group',
            'styled-select' => 'Select (Custom)',
            'select' => 'Select (Native)',
            'switch-toggle' => 'Switch Toggle',
            'textarea' => 'Textarea',
            'toggle' => 'Toggle',
            'toggle-group' => 'Toggle Group',
        ],
        'default_value' => 'input',
    ])
    ->addGroup('input_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [
                ['field' => 'control_type', 'operator' => '==', 'value' => 'input'],
            ]
        ],
    ])
    ->addFields($input_fields['full'])
    ->endGroup()
    ->addGroup('textarea_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [
                ['field' => 'control_type', 'operator' => '==', 'value' => 'textarea'],
            ]
        ],
    ])
    ->addFields($textarea_fields['full'])
    ->endGroup()
    ->addGroup('select_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [
                ['field' => 'control_type', 'operator' => '==', 'value' => 'select'],
            ]
        ],
    ])
    ->addFields($select_fields['full'])
    ->endGroup()
    ->addGroup('checkbox_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [['field' => 'control_type', 'operator' => '==', 'value' => 'checkbox']],
            [['field' => 'control_type', 'operator' => '==', 'value' => 'switch-toggle']],
            [['field' => 'control_type', 'operator' => '==', 'value' => 'toggle']],
        ],
    ])
    ->addFields($checkbox_fields['full'])
    ->endGroup()
    ->addGroup('checkbox_group_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [['field' => 'control_type', 'operator' => '==', 'value' => 'checkbox-group']],
        ],
    ])
    ->addFields($checkbox_group_fields['full'])
    ->endGroup()
    ->addGroup('combobox_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [
                ['field' => 'control_type', 'operator' => '==', 'value' => 'combobox'],
            ]
        ],
    ])
    ->addFields($combobox_fields['full'])
    ->endGroup()
    ->addGroup('date_picker_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [
                ['field' => 'control_type', 'operator' => '==', 'value' => 'date-picker'],
            ]
        ],
    ])
    ->addFields($date_picker_fields['full'])
    ->endGroup()
    ->addGroup('radio_group_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [
                ['field' => 'control_type', 'operator' => '==', 'value' => 'radio-group'],
            ]
        ],
    ])
    ->addFields($radio_group_fields['full'])
    ->endGroup()
    ->addGroup('styled_select_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [
                ['field' => 'control_type', 'operator' => '==', 'value' => 'styled-select'],
            ]
        ],
    ])
    ->addFields($styled_select_fields['full'])
    ->endGroup()
    ->addGroup('toggle_group_fields', [
        'label' => '',
        'layout' => 'block',
        'conditional_logic' => [
            [
                ['field' => 'control_type', 'operator' => '==', 'value' => 'toggle-group'],
            ]
        ],
    ])
    ->addFields($toggle_group_fields['full'])
    ->endGroup();

return [
    'full' => $field_full_fields,
];
