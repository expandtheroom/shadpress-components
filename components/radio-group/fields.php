<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $radio_group_fields = require(get_stylesheet_directory() . '/components/radio-group/radio_group_fields.php');
    $fields->addFields($radio_group_fields['full']);
};
