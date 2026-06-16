<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $tabs_fields = require(get_stylesheet_directory() . '/components/tabs/tabs_fields.php');
    $fields->addFields($tabs_fields['full']);

    $providers = apply_filters('theme/icon_providers', []);
    if (empty($providers)) return;

    $first_key = array_key_first($providers);
    $is_multi  = count($providers) > 1;

    $provider_choices = [];
    foreach ($providers as $key => $provider) {
        $provider_choices[$key] = $provider['label'];
    }

    $fields->addSelect('icon_provider', [
        'label'         => 'Icon Provider',
        'choices'       => $provider_choices,
        'default_value' => $first_key,
        'wrapper'       => $is_multi ? [] : ['class' => 'hidden'],
    ]);

    $fields->addRadio('icon_position', [
        'label'         => 'Icon Position',
        'choices'       => ['left' => 'Left', 'right' => 'Right'],
        'default_value' => 'left',
        'layout'        => 'horizontal',
    ]);
};
