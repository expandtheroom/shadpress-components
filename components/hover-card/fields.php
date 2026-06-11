<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $hover_card_fields = require(get_stylesheet_directory() . '/components/hover-card/hover_card_fields.php');
    $fields->addFields($hover_card_fields['full']);
};
