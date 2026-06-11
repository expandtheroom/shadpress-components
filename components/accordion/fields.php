<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $accordion_fields = require(get_stylesheet_directory() . '/components/accordion/accordion_fields.php');
    $fields->addFields($accordion_fields['full']);
};
