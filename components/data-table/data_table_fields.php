<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$data_table_caption_field = (new FieldsBuilder('data_table_caption_fields'));
$data_table_caption_field->addText('caption', ['label' => 'Caption']);

$data_table_filterable_field = (new FieldsBuilder('data_table_filterable_fields'));
$data_table_filterable_field->addTrueFalse('filterable', [
    'label'         => 'Enable Text Filter',
    'ui'            => 1,
    'default_value' => 0,
]);

$data_table_headers_field = (new FieldsBuilder('data_table_headers_fields'));
$data_table_headers_field
    ->addRepeater('headers', [
        'label'  => 'Column Headers',
        'min'    => 1,
        'layout' => 'block',
    ])
    ->addText('label', [
        'label'    => 'Label',
        'required' => 1,
    ])
    ->addText('key', [
        'label'    => 'Key',
        'required' => 1,
    ])
    ->addTrueFalse('sortable', [
        'label'         => 'Sortable',
        'ui'            => 1,
        'default_value' => 0,
    ])
    ->endRepeater();

$data_table_rows_field = (new FieldsBuilder('data_table_rows_fields'));
$data_table_rows_field
    ->addRepeater('rows', [
        'label'  => 'Rows',
        'layout' => 'block',
    ])
    ->addRepeater('cells', [
        'label'  => 'Cells',
        'layout' => 'table',
    ])
    ->addText('content', ['label' => 'Content'])
    ->endRepeater()
    ->endRepeater();

$data_table_full_fields = (new FieldsBuilder('data_table_component_fields'));
$data_table_full_fields
    ->addFields($data_table_caption_field)
    ->addFields($data_table_filterable_field)
    ->addFields($data_table_headers_field)
    ->addFields($data_table_rows_field);

return [
    'caption'    => $data_table_caption_field,
    'filterable' => $data_table_filterable_field,
    'headers'    => $data_table_headers_field,
    'rows'       => $data_table_rows_field,
    'full'       => $data_table_full_fields,
];
