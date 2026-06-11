<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$dialog_trigger_label_field = (new FieldsBuilder('dialog_trigger_label_fields'));
$dialog_trigger_label_field->addText('trigger_label', ['label' => 'Trigger Button Label', 'required' => 1]);

$trigger_variant_choices = [
    'default'   => 'Default',
    'outline'   => 'Outline',
    'secondary' => 'Secondary',
    'ghost'     => 'Ghost',
];

$dialog_trigger_variant_field = (new FieldsBuilder('dialog_trigger_variant_fields'));
$dialog_trigger_variant_field->addSelect('trigger_variant', [
    'label'         => 'Trigger Button Variant',
    'choices'       => $trigger_variant_choices,
    'default_value' => 'default',
]);

$dialog_title_field = (new FieldsBuilder('dialog_title_fields'));
$dialog_title_field->addText('title', ['label' => 'Dialog Title', 'required' => 1]);

$dialog_description_field = (new FieldsBuilder('dialog_description_fields'));
$dialog_description_field->addTextarea('description', ['label' => 'Description', 'rows' => 2]);

$dialog_content_field = (new FieldsBuilder('dialog_content_fields'));
$dialog_content_field->addWysiwyg('dialog_content', ['label' => 'Content', 'media_upload' => 0]);

$dialog_close_label_field = (new FieldsBuilder('dialog_close_label_fields'));
$dialog_close_label_field->addText('close_label', [
    'label'         => 'Close Button Label',
    'default_value' => 'Close',
]);

$dialog_full_fields = (new FieldsBuilder('dialog_component_fields'));
$dialog_full_fields
    ->addFields($dialog_trigger_label_field)
    ->addFields($dialog_trigger_variant_field)
    ->addFields($dialog_title_field)
    ->addFields($dialog_description_field)
    ->addFields($dialog_content_field)
    ->addFields($dialog_close_label_field);

return [
    'trigger_label'           => $dialog_trigger_label_field,
    'trigger_variant'         => $dialog_trigger_variant_field,
    'trigger_variant_choices' => $trigger_variant_choices,
    'title'                   => $dialog_title_field,
    'description'             => $dialog_description_field,
    'content'                 => $dialog_content_field,
    'close_label'             => $dialog_close_label_field,
    'full'                    => $dialog_full_fields,
];
