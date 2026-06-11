<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $checkbox_fields = require(get_stylesheet_directory() . '/components/checkbox/checkbox_fields.php');
    $fields->addFields($checkbox_fields['full']);
};
