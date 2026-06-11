<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $select_fields = require(get_stylesheet_directory() . '/components/select/select_fields.php');
    $fields->addFields($select_fields['full']);
};
