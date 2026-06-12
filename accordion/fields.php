<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $accordion_fields = require(get_stylesheet_directory() . '/components/accordion/accordion_fields.php');
    $fields->addFields($accordion_fields['type']);

    $providers = apply_filters('theme/icon_providers', []);
    if (!empty($providers)) {
        $first_key = array_key_first($providers);
        $is_multi  = count($providers) > 1;

        $provider_choices = [];
        foreach ($providers as $key => $provider) {
            $provider_choices[$key] = $provider['label'];
        }

        $fields->addTrueFalse('include_icon', ['label' => 'Include Icons', 'default_value' => 0, 'ui' => true]);

        $fields->addSelect('icon_provider', [
            'label'         => 'Icon Provider',
            'choices'       => $provider_choices,
            'default_value' => $first_key,
            'wrapper'       => $is_multi ? [] : ['class' => 'hidden'],
        ]);
        $fields->getField('icon_provider')->conditional('include_icon', '==', '1');
    }

    $fields->addFields($accordion_fields['panels']);
};
