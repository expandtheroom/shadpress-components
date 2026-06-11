<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $table_fields = require(get_stylesheet_directory() . '/components/table/table_fields.php');
    $fields->addFields($table_fields['full']);
};
