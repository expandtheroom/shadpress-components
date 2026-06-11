<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $tabs_fields = require(get_stylesheet_directory() . '/components/tabs/tabs_fields.php');
    $fields->addFields($tabs_fields['full']);
};
