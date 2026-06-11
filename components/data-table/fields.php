<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $data_table_fields = require(get_stylesheet_directory() . '/components/data-table/data_table_fields.php');
    $fields->addFields($data_table_fields['full']);
};
