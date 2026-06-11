<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$collapsible_trigger_field = (new FieldsBuilder('collapsible_trigger_fields'));
$collapsible_trigger_field->addText('trigger_label', [
    'label'    => 'Trigger Label',
    'required' => 1,
]);

$collapsible_content_field = (new FieldsBuilder('collapsible_content_fields'));
$collapsible_content_field->addWysiwyg('body', [
    'label' => 'Content',
]);

$collapsible_open_field = (new FieldsBuilder('collapsible_open_fields'));
$collapsible_open_field->addTrueFalse('open', [
    'label'         => 'Open by default',
    'ui'            => 1,
    'default_value' => 0,
]);

$collapsible_full_fields = (new FieldsBuilder('collapsible_component_fields'));
$collapsible_full_fields
    ->addFields($collapsible_trigger_field)
    ->addFields($collapsible_content_field)
    ->addFields($collapsible_open_field);

return [
    'trigger_label' => $collapsible_trigger_field,
    'body'          => $collapsible_content_field,
    'open'          => $collapsible_open_field,
    'full'          => $collapsible_full_fields,
];
