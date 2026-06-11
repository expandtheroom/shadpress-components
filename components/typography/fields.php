<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $typography_fields = require(get_stylesheet_directory() . '/components/typography/typography_fields.php');
    $fields->addFields($typography_fields['full']);
};
