<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$source_choices = [
    'auto'   => 'Auto (WordPress)',
    'manual' => 'Manual',
];
$breadcrumb_source_field = (new FieldsBuilder('breadcrumb_source_fields'));
$breadcrumb_source_field->addSelect('source', [
    'label'         => 'Source',
    'choices'       => $source_choices,
    'default_value' => 'auto',
]);

$separator_choices = [
    '/'  => '/ Slash',
    '>'  => '> Chevron',
    '›'  => '› Right angle',
    '→'  => '→ Arrow',
];
$breadcrumb_separator_field = (new FieldsBuilder('breadcrumb_separator_fields'));
$breadcrumb_separator_field->addSelect('separator', [
    'label'         => 'Separator',
    'choices'       => $separator_choices,
    'default_value' => '/',
]);

$breadcrumb_items_field = (new FieldsBuilder('breadcrumb_items_fields'));
$breadcrumb_items_field
    ->addRepeater('crumbs', [
        'label'  => 'Crumbs',
        'min'    => 1,
        'layout' => 'row',
    ])
        ->addLink('link', ['label' => 'Link', 'required' => 1])
        ->addTrueFalse('is_current', [
            'label'         => 'Current Page',
            'default_value' => 0,
            'ui'            => 1,
        ])
    ->endRepeater();

// Assemble
$breadcrumb_full_fields = (new FieldsBuilder('breadcrumb_component_fields'));
$breadcrumb_full_fields
    ->addFields($breadcrumb_source_field)
    ->addFields($breadcrumb_separator_field)
    ->addFields($breadcrumb_items_field);

// Items repeater is only shown when source is set to manual
$breadcrumb_full_fields->getField('crumbs')->conditional('source', '==', 'manual');

// Use like:
//   $breadcrumb_fields = require(get_stylesheet_directory() . '/components/breadcrumbs/breadcrumbs_fields.php');
//   $fields->addFields($breadcrumb_fields['full']);
return [
    'source'            => $breadcrumb_source_field,
    'source_choices'    => $source_choices,
    'separator'         => $breadcrumb_separator_field,
    'separator_choices' => $separator_choices,
    'crumbs'            => $breadcrumb_items_field,
    'full'              => $breadcrumb_full_fields,
];
