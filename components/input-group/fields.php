<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $input_group_fields = require(get_stylesheet_directory() . '/components/input-group/input_group_fields.php');
    $fields->addFields($input_group_fields['full']);
};
