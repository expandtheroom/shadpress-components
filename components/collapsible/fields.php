<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $collapsible_fields = require(get_stylesheet_directory() . '/components/collapsible/collapsible_fields.php');
    $fields->addFields($collapsible_fields['full']);
};
