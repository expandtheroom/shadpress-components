<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $dropdown_menu_fields = require(get_stylesheet_directory() . '/components/dropdown-menu/dropdown_menu_fields.php');
    $fields->addFields($dropdown_menu_fields['full']);
};
