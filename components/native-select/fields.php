<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $native_select_fields = require(get_stylesheet_directory() . '/components/native-select/native_select_fields.php');
    $fields->addFields($native_select_fields['full']);
};
