<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $input_fields = require(get_stylesheet_directory() . '/components/input/input_fields.php');
    $fields->addFields($input_fields['full']);
};
