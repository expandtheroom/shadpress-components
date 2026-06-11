<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $image_icon_fields = require( get_stylesheet_directory() . '/components/image-icon/image_icon_fields.php' );
    $fields->addFields( $image_icon_fields['full'] );
};
