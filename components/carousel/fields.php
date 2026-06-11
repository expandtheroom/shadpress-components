<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $carousel_fields = require(get_stylesheet_directory() . '/components/carousel/carousel_fields.php');
    $fields->addFields($carousel_fields['full']);
};
