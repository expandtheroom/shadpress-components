<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$native_select_field_fields = require __DIR__ . '/native_select_field_fields.php';

return function (FieldsBuilder $fields) use ($native_select_field_fields) {
    $fields->addFields($native_select_field_fields['full']);
};
