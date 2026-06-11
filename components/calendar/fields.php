<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $calendar_fields = require(get_stylesheet_directory() . '/components/calendar/calendar_fields.php');
    $fields->addFields($calendar_fields['full']);
};
