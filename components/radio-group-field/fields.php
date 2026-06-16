<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $radio_group_fields = require(get_stylesheet_directory() . '/components/radio-group-field/radio_group_field_fields.php');
    $fields->addFields($radio_group_fields['full']);
};
