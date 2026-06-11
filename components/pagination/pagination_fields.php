<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$pagination_fields = new FieldsBuilder('pagination_fields');

$pagination_fields
    ->addNumber('mid_size', [
        'label'         => 'Mid Size',
        'default_value' => 2,
        'min'           => 0,
        'max'           => 10,
    ]);

return [
    'mid_size' => $pagination_fields->getField('mid_size'),
    'full'     => $pagination_fields,
];
