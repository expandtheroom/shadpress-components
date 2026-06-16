<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $cbf_fields = require(get_stylesheet_directory() . '/components/checkbox-field/checkbox_field_fields.php');
    $fields->addFields($cbf_fields['full']);
};
