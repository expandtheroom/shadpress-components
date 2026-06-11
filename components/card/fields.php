<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $card_fields = require(get_stylesheet_directory() . '/components/card/card_fields.php');
    $fields->addFields($card_fields['full']);
};
