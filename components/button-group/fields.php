<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $button_group_fields = require(get_stylesheet_directory() . '/components/button-group/button_group_fields.php');
    $fields->addFields($button_group_fields['full']);
};
