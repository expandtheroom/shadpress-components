<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $label_fields = require(get_stylesheet_directory() . '/components/label/label_fields.php');
    $fields->addFields($label_fields['full']);
};
