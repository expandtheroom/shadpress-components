<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $alert_dialog_fields = require(get_stylesheet_directory() . '/components/alert-dialog/alert_dialog_fields.php');
    $fields->addFields($alert_dialog_fields['full']);
};
