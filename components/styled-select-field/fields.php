<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $select_fields = require(get_stylesheet_directory() . '/components/styled-select-field/styled_select_field_fields.php');
    $fields->addFields($select_fields['full']);
};
