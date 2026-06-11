<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $navigation_menu_fields = require(get_stylesheet_directory() . '/components/navigation-menu/navigation_menu_fields.php');
    $fields->addFields($navigation_menu_fields['full']);
};
