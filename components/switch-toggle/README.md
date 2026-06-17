# SwitchToggle

Toggle switch for boolean form input.

**shadcn/ui:** [switch](https://ui.shadcn.com/docs/components/switch)

> **Note:** This is a raw control — it renders only the toggle switch with no label, description, or error state. For a complete form field use [`CheckboxField`](../checkbox-field/README.md) (`component: 'switch-toggle'`). For ACF block use, see [`FormField`](../form-field/README.md).

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Visible label text |
| `name` | `string` | `''` | HTML `name` attribute |
| `value` | `string` | `'1'` | Value submitted when toggled on |
| `checked` | `bool` | `false` | Initial on/off state |
| `required` | `bool` | `false` | Marks the field as required |
| `disabled` | `bool` | `false` | Disables the toggle |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\SwitchToggle(
        label: 'Enable notifications',
        name: 'notifications',
        checked: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\SwitchToggle(
        label: 'Enable notifications',
        name: 'notifications',
        checked: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\SwitchToggle(
    label: 'Enable notifications',
    name: 'notifications',
    checked: true,
) ?>
```

### Via global helpers

```php
the_component('switch-toggle', [
    'label' => 'Enable notifications',
    'name' => 'notifications',
    'checked' => true,
]);

$html = get_component('switch-toggle', [
    'label' => 'Enable notifications',
    'name' => 'notifications',
    'checked' => true,
]);
```

## ACF Fields

Fields are defined in `switch_toggle_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All switch-toggle fields as a single group |
| `label` | `FieldsBuilder` | Label text field |
| `name` | `FieldsBuilder` | Input name text field |
| `checked` | `FieldsBuilder` | Initially checked true/false field |
| `disabled` | `FieldsBuilder` | Disabled true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $switch_toggle_fields = require get_stylesheet_directory() . '/components/switch-toggle/switch_toggle_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($switch_toggle_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $switch_toggle_fields = require get_stylesheet_directory() . '/components/switch-toggle/switch_toggle_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($switch_toggle_fields['label'])
        ->addFields($switch_toggle_fields['checked']);
};
```
