<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $get_icon_fields = require get_stylesheet_directory() . '/components/lucide-icons/lucide_icon_fields.php';
    $icon_fields     = $get_icon_fields();
    $fields->addFields($icon_fields['full']);
};
