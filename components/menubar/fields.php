<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $menubar_fields = require(get_stylesheet_directory() . '/components/menubar/menubar_fields.php');
    $fields->addFields($menubar_fields['full']);
};
