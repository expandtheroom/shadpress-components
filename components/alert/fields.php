<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $alert_fields = require(get_stylesheet_directory() . '/components/alert/alert_fields.php');
    $fields->addFields($alert_fields['full']);
};
