<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $empty_state_fields = require(get_stylesheet_directory() . '/components/empty-state/empty_state_fields.php');
    $fields->addFields($empty_state_fields['full']);
};
