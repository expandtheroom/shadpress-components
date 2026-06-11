<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $breadcrumb_fields = require(get_stylesheet_directory() . '/components/breadcrumbs/breadcrumbs_fields.php');
    $fields->addFields($breadcrumb_fields['full']);
};
