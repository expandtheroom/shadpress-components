<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $separator_fields = require(get_stylesheet_directory() . '/components/separator/separator_fields.php');
    $fields->addFields($separator_fields['full']);
};
