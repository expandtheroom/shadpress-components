<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $scroll_area_fields = require(get_stylesheet_directory() . '/components/scroll-area/scroll_area_fields.php');
    $fields->addFields($scroll_area_fields['full']);
};
