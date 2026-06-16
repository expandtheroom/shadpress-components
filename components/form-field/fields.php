<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $field_fields = require(get_stylesheet_directory() . '/components/form-field/form_field_fields.php');
    $fields->addFields($field_fields['full']);
};
