<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $toggle_group_fields = require(get_stylesheet_directory() . '/components/toggle-group/toggle_group_fields.php');
    $fields->addFields($toggle_group_fields['full']);
};
