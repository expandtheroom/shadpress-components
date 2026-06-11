<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $textarea_fields = require(get_stylesheet_directory() . '/components/textarea/textarea_fields.php');
    $fields->addFields($textarea_fields['full']);
};
