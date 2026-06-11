<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $switch_toggle_fields = require(get_stylesheet_directory() . '/components/switch-toggle/switch_toggle_fields.php');
    $fields->addFields($switch_toggle_fields['full']);
};
