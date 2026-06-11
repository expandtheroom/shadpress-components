<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$hover_card_trigger_label_field = (new FieldsBuilder('hover_card_trigger_label_fields'));
$hover_card_trigger_label_field->addText('trigger_label', [
    'label'    => 'Trigger Label',
    'required' => 1,
]);

$hover_card_trigger_url_field = (new FieldsBuilder('hover_card_trigger_url_fields'));
$hover_card_trigger_url_field->addUrl('trigger_url', [
    'label' => 'Trigger URL',
]);

$hover_card_content_field = (new FieldsBuilder('hover_card_content_fields'));
$hover_card_content_field->addWysiwyg('card_content', [
    'label'        => 'Card Content',
    'media_upload' => 0,
]);

$side_choices = [
    'bottom' => 'Bottom',
    'top'    => 'Top',
    'left'   => 'Left',
    'right'  => 'Right',
];
$hover_card_side_field = (new FieldsBuilder('hover_card_side_fields'));
$hover_card_side_field->addSelect('side', [
    'label'         => 'Position (Side)',
    'choices'       => $side_choices,
    'default_value' => 'bottom',
]);

$align_choices = [
    'center' => 'Center',
    'start'  => 'Start',
    'end'    => 'End',
];
$hover_card_align_field = (new FieldsBuilder('hover_card_align_fields'));
$hover_card_align_field->addSelect('align', [
    'label'         => 'Alignment',
    'choices'       => $align_choices,
    'default_value' => 'center',
]);

// Assemble
$hover_card_full_fields = (new FieldsBuilder('hover_card_component_fields'));
$hover_card_full_fields
    ->addFields($hover_card_trigger_label_field)
    ->addFields($hover_card_trigger_url_field)
    ->addFields($hover_card_content_field)
    ->addFields($hover_card_side_field)
    ->addFields($hover_card_align_field);

// Use like:
//   $hover_card_fields = require(get_stylesheet_directory() . '/components/hover-card/hover_card_fields.php');
//   $fields->addFields($hover_card_fields['full']);
return [
    'trigger_label'  => $hover_card_trigger_label_field,
    'trigger_url'    => $hover_card_trigger_url_field,
    'card_content'   => $hover_card_content_field,
    'side'           => $hover_card_side_field,
    'side_choices'   => $side_choices,
    'align'          => $hover_card_align_field,
    'align_choices'  => $align_choices,
    'full'           => $hover_card_full_fields,
];
