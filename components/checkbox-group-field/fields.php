<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$checkbox_group_fields = require __DIR__ . '/checkbox_group_field_fields.php';

return function ( FieldsBuilder $fields ) use ( $checkbox_group_fields ) {
    $fields->addFields($checkbox_group_fields['full']);
};
