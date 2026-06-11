<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$textarea_field_fields = require __DIR__ . '/textarea_field_fields.php';

return function (FieldsBuilder $fields) use ($textarea_field_fields) {
    $fields->addFields($textarea_field_fields['full']);
};
