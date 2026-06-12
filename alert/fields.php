<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $alert_fields = require(get_stylesheet_directory() . '/components/alert/alert_fields.php');
    $fields->addFields($alert_fields['full']);

    $providers = apply_filters('theme/icon_providers', []);
    if (empty($providers)) return;

    $first_key = array_key_first($providers);
    $is_multi  = count($providers) > 1;

    $provider_choices = [];
    foreach ($providers as $key => $provider) {
        $provider_choices[$key] = $provider['label'];
    }

    $fields->addTrueFalse('include_icon', ['label' => 'Include Icon', 'default_value' => 0, 'ui' => true]);

    $fields->addSelect('icon_provider', [
        'label'         => 'Icon Provider',
        'choices'       => $provider_choices,
        'default_value' => $first_key,
        'wrapper'       => $is_multi ? [] : ['class' => 'hidden'],
    ]);
    $fields->getField('icon_provider')->conditional('include_icon', '==', '1');

    foreach ($providers as $key => $provider) {
        $field_name = 'icon_' . str_replace('-', '_', $key);
        $fields->addField($field_name, $provider['field_type'], $provider['field_args']);
        $icon_field = $fields->getField($field_name);
        if ($is_multi) {
            $icon_field->conditional('include_icon', '==', '1')->and('icon_provider', '==', $key);
        } else {
            $icon_field->conditional('include_icon', '==', '1');
        }
    }
};
