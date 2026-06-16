<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $date_picker_fields = require(get_stylesheet_directory() . '/components/date-picker-field/date_picker_fields.php');
    $fields->addFields($date_picker_fields['full']);
};
