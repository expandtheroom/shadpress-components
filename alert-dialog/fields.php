<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $alert_dialog_fields = require(get_stylesheet_directory() . '/components/alert-dialog/alert_dialog_fields.php');
    $fields->addFields($alert_dialog_fields['full']);

    $providers = apply_filters('theme/icon_providers', []);
    if (empty($providers)) return;

    $first_key = array_key_first($providers);
    $is_multi  = count($providers) > 1;

    $provider_choices = [];
    foreach ($providers as $key => $provider) {
        $provider_choices[$key] = $provider['label'];
    }

    // — Trigger button icon —
    $fields->addTrueFalse('trigger_include_icon', [
        'label'         => 'Include Icon on Trigger',
        'default_value' => 0,
    ]);

    $fields->addSelect('trigger_icon_provider', [
        'label'         => 'Trigger Icon Provider',
        'choices'       => $provider_choices,
        'default_value' => $first_key,
        'wrapper'       => $is_multi ? [] : ['class' => 'hidden'],
    ]);
    $fields->getField('trigger_icon_provider')->conditional('trigger_include_icon', '==', '1');

    foreach ($providers as $key => $provider) {
        $field_name = 'trigger_icon_' . str_replace('-', '_', $key);
        $fields->addField($field_name, $provider['field_type'], $provider['field_args']);
        $icon_field = $fields->getField($field_name);
        if ($is_multi) {
            $icon_field->conditional('trigger_include_icon', '==', '1')->and('trigger_icon_provider', '==', $key);
        } else {
            $icon_field->conditional('trigger_include_icon', '==', '1');
        }
    }

    $fields->addRadio('trigger_icon_position', [
        'label'         => 'Trigger Icon Position',
        'choices'       => ['left' => 'Left', 'right' => 'Right'],
        'default_value' => 'left',
        'layout'        => 'horizontal',
    ]);
    $fields->getField('trigger_icon_position')->conditional('trigger_include_icon', '==', '1');

    // — Header icon —
    $fields->addTrueFalse('header_include_icon', [
        'label'         => 'Include Icon in Header',
        'default_value' => 0,
    ]);

    $fields->addSelect('header_icon_provider', [
        'label'         => 'Header Icon Provider',
        'choices'       => $provider_choices,
        'default_value' => $first_key,
        'wrapper'       => $is_multi ? [] : ['class' => 'hidden'],
    ]);
    $fields->getField('header_icon_provider')->conditional('header_include_icon', '==', '1');

    foreach ($providers as $key => $provider) {
        $field_name = 'header_icon_' . str_replace('-', '_', $key);
        $fields->addField($field_name, $provider['field_type'], $provider['field_args']);
        $icon_field = $fields->getField($field_name);
        if ($is_multi) {
            $icon_field->conditional('header_include_icon', '==', '1')->and('header_icon_provider', '==', $key);
        } else {
            $icon_field->conditional('header_include_icon', '==', '1');
        }
    }
};
