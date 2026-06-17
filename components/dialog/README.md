# Dialog

Modal dialog with configurable trigger button and typography content.

**shadcn/ui:** [dialog](https://ui.shadcn.com/docs/components/dialog)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `trigger_label` | `string` | `''` | Trigger button label |
| `title` | `string` | `''` | Dialog heading |
| `description` | `string` | `''` | Dialog subtitle text |
| `trigger_variant` | `string` | `'outline'` | Trigger button variant |
| `trigger_include_icon` | `bool\|int` | `0` | Whether to render an icon on the trigger button |
| `trigger_icon_provider` | `string` | `''` | Trigger icon provider key |
| `trigger_icon_lucide_icons` | `string` | `''` | Lucide icon name for trigger |
| `trigger_icon_image_icon` | `string` | `''` | Image icon value for trigger |
| `trigger_icon_position` | `string` | `'left'` | Trigger icon position: `'left'` or `'right'` |
| `header_include_icon` | `bool\|int` | `0` | Whether to render an icon in the dialog header |
| `header_icon_provider` | `string` | `''` | Header icon provider key |
| `header_icon_lucide_icons` | `string` | `''` | Lucide icon name for header |
| `header_icon_image_icon` | `string` | `''` | Image icon value for header |
| `dialog_content` | `string` | `''` | HTML body content inside the dialog |
| `close_label` | `string` | `'Close'` | Close button label |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->modal ?>
    $this->modal = new \Theme\Components\Dialog(
        trigger_label: 'Open settings',
        title: 'Settings',
        description: 'Adjust your preferences below.',
        dialog_content: '<p>Settings form goes here.</p>',
        close_label: 'Close',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Dialog(
        trigger_label: 'Open settings',
        title: 'Settings',
        description: 'Adjust your preferences below.',
        dialog_content: '<p>Settings form goes here.</p>',
        close_label: 'Close',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Dialog(
    trigger_label: 'Open settings',
    title: 'Settings',
    description: 'Adjust your preferences below.',
    dialog_content: '<p>Settings form goes here.</p>',
    close_label: 'Close',
) ?>
```

### Via global helpers

```php
the_component('dialog', [
    'trigger_label' => 'Open settings',
    'title' => 'Settings',
    'description' => 'Adjust your preferences below.',
    'dialog_content' => '<p>Settings form goes here.</p>',
    'close_label' => 'Close',
]);

$html = get_component('dialog', [
    'trigger_label' => 'Open settings',
    'title' => 'Settings',
    'description' => 'Adjust your preferences below.',
    'dialog_content' => '<p>Settings form goes here.</p>',
    'close_label' => 'Close',
]);
```

## ACF Fields

Fields are defined in `dialog_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All dialog fields as a single group |
| `trigger_label` | `FieldsBuilder` | Trigger button label text field |
| `trigger_variant` | `FieldsBuilder` | Trigger button variant select field |
| `trigger_variant_choices` | `array` | Raw choices array for trigger variant |
| `title` | `FieldsBuilder` | Dialog title text field |
| `description` | `FieldsBuilder` | Dialog description text field |
| `content` | `FieldsBuilder` | Body content WYSIWYG field |
| `close_label` | `FieldsBuilder` | Close button label text field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $dialog_fields = require get_stylesheet_directory() . '/components/dialog/dialog_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($dialog_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $dialog_fields = require get_stylesheet_directory() . '/components/dialog/dialog_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($dialog_fields['trigger_label'])
        ->addFields($dialog_fields['content']);
};
```
