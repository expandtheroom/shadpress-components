<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $button_fields = require(get_stylesheet_directory() . '/components/button/button_fields.php');
    $fields->addFields($button_fields['full']);
};
