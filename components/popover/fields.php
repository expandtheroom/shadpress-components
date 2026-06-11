<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $popover_fields = require(get_stylesheet_directory() . '/components/popover/popover_fields.php');
    $fields->addFields($popover_fields['full']);
};
