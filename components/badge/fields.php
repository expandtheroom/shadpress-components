<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $badge_fields = require(get_stylesheet_directory() . '/components/badge/badge_fields.php');
    $fields->addFields($badge_fields['full']);
};
