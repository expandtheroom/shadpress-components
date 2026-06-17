# Alert Dialog

Modal dialog for confirming actions with customizable buttons.

**shadcn/ui:** [Alert Dialog](https://ui.shadcn.com/docs/components/alert-dialog)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `trigger_label` | `string` | `''` | Label text for the trigger button |
| `title` | `string` | `''` | Dialog heading |
| `description` | `string` | `''` | Dialog body text |
| `cancel_label` | `string` | `'Cancel'` | Cancel button label |
| `confirm_label` | `string` | `'Continue'` | Confirm button label |
| `variant` | `string` | `'default'` | Confirm button visual style |
| `trigger_include_icon` | `bool\|int` | `0` | Whether to render an icon on the trigger button |
| `trigger_icon_provider` | `string` | `''` | Trigger icon provider key |
| `trigger_icon_lucide_icons` | `string` | `''` | Lucide icon name for trigger |
| `trigger_icon_image_icon` | `string` | `''` | Image icon value for trigger |
| `trigger_icon_position` | `string` | `'left'` | Trigger icon position: `'left'` or `'right'` |
| `header_include_icon` | `bool\|int` | `0` | Whether to render an icon in the dialog header |
| `header_icon_provider` | `string` | `''` | Header icon provider key |
| `header_icon_lucide_icons` | `string` | `''` | Lucide icon name for header |
| `header_icon_image_icon` | `string` | `''` | Image icon value for header |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->dialog ?>
    $this->dialog = new \Theme\Components\AlertDialog(
        trigger_label: 'Delete account',
        title: 'Are you absolutely sure?',
        description: 'This will permanently delete your account.',
        cancel_label: 'Cancel',
        confirm_label: 'Delete',
        variant: 'destructive',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\AlertDialog(
        trigger_label: 'Delete account',
        title: 'Are you absolutely sure?',
        description: 'This will permanently delete your account.',
        cancel_label: 'Cancel',
        confirm_label: 'Delete',
        variant: 'destructive',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\AlertDialog(
    trigger_label: 'Delete account',
    title: 'Are you absolutely sure?',
    description: 'This will permanently delete your account.',
    cancel_label: 'Cancel',
    confirm_label: 'Delete',
    variant: 'destructive',
) ?>
```

### Via global helpers

```php
the_component('alert-dialog', [
    'trigger_label' => 'Delete account',
    'title'         => 'Are you absolutely sure?',
    'description'   => 'This will permanently delete your account.',
    'cancel_label'  => 'Cancel',
    'confirm_label' => 'Delete',
    'variant'       => 'destructive',
]);

$html = get_component('alert-dialog', [
    'trigger_label' => 'Delete account',
    'title'         => 'Are you absolutely sure?',
    'description'   => 'This will permanently delete your account.',
    'cancel_label'  => 'Cancel',
    'confirm_label' => 'Delete',
    'variant'       => 'destructive',
]);
```

## ACF Fields

Fields are defined in `alert_dialog_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All alert-dialog fields as a single group |
| `trigger_label` | `FieldsBuilder` | Trigger button label text field |
| `title` | `FieldsBuilder` | Dialog title text field |
| `description` | `FieldsBuilder` | Dialog description text field |
| `cancel_label` | `FieldsBuilder` | Cancel button label text field |
| `confirm_label` | `FieldsBuilder` | Confirm button label text field |
| `variant` | `FieldsBuilder` | Confirm button variant select field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $alert_dialog_fields = require get_stylesheet_directory() . '/components/alert-dialog/alert_dialog_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($alert_dialog_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $alert_dialog_fields = require get_stylesheet_directory() . '/components/alert-dialog/alert_dialog_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($alert_dialog_fields['trigger_label'])
        ->addFields($alert_dialog_fields['title']);
};
```
