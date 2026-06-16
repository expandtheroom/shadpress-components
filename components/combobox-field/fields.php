<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $combobox_fields = require(get_stylesheet_directory() . '/components/combobox-field/combobox_fields.php');
    $fields->addFields($combobox_fields['full']);
};
