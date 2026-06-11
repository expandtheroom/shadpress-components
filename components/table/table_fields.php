<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$table_caption_field = (new FieldsBuilder('table_caption_fields'));
$table_caption_field->addText('caption', [
    'label' => 'Caption',
]);

$table_headers_field = (new FieldsBuilder('table_headers_fields'));
$table_headers_field
    ->addRepeater('headers', [
        'label'  => 'Column Headers',
        'layout' => 'table',
    ])
        ->addText('label', [
            'label'    => 'Header Label',
            'required' => 1,
        ])
    ->endRepeater();

$table_rows_field = (new FieldsBuilder('table_rows_fields'));
$table_rows_field
    ->addRepeater('rows', [
        'label'  => 'Rows',
        'layout' => 'block',
    ])
        ->addRepeater('cells', [
            'label'  => 'Cells',
            'layout' => 'table',
        ])
            ->addText('content', [
                'label' => 'Cell Content',
            ])
        ->endRepeater()
    ->endRepeater();

$table_full_fields = (new FieldsBuilder('table_component_fields'));
$table_full_fields
    ->addFields($table_caption_field)
    ->addFields($table_headers_field)
    ->addFields($table_rows_field);

return [
    'caption' => $table_caption_field,
    'headers' => $table_headers_field,
    'rows'    => $table_rows_field,
    'full'    => $table_full_fields,
];
