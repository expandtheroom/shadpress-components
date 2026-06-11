<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $toggle_fields = require(get_stylesheet_directory() . '/components/toggle/toggle_fields.php');
    $fields->addFields($toggle_fields['full']);
};
