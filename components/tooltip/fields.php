<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $tooltip_fields = require(get_stylesheet_directory() . '/components/tooltip/tooltip_fields.php');
    $fields->addFields($tooltip_fields['full']);
};
