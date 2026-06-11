<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $pagination_fields = require(get_stylesheet_directory() . '/components/pagination/pagination_fields.php');
    $fields->addFields($pagination_fields['full']);
};
