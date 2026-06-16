<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$empty_state_title_field = (new FieldsBuilder('empty_state_title_fields'));
$empty_state_title_field->addText('title', ['label' => 'Title', 'required' => 1]);

$empty_state_description_field = (new FieldsBuilder('empty_state_description_fields'));
$empty_state_description_field->addText('description', [
    'label' => 'Description',
    'instructions' => 'Optional helper sentence below the title.',
]);

$empty_state_action_link_field = (new FieldsBuilder('empty_state_action_link_fields'));
$empty_state_action_link_field->addLink('action_link', ['label' => 'Action Link']);

$empty_state_full_fields = (new FieldsBuilder('empty_state_component_fields'));
$empty_state_full_fields
    ->addFields($empty_state_title_field)
    ->addFields($empty_state_description_field)
    ->addFields($empty_state_action_link_field);

return [
    'title' => $empty_state_title_field,
    'description' => $empty_state_description_field,
    'action_link' => $empty_state_action_link_field,
    'full' => $empty_state_full_fields,
];
