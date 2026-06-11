<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $dialog_fields = require(get_stylesheet_directory() . '/components/dialog/dialog_fields.php');
    $fields->addFields($dialog_fields['full']);
};
