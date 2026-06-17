# Checkbox Field

Form field wrapper for checkbox with label, description, and error handling.

The `component` prop switches which raw control is rendered:

| `component` | Rendered as |
|-------------|-------------|
| `'checkbox'` (default) | `Checkbox` |
| `'switch-toggle'` | `SwitchToggle` |
| `'toggle'` | `Toggle` |

`size` and `variant` are only meaningful when `component` is `'toggle'`.

**shadcn/ui:** [Checkbox](https://ui.shadcn.com/docs/components/checkbox)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `component` | `string` | `'checkbox'` | Which control to render: `'checkbox'`, `'switch-toggle'`, `'toggle'` |
| `checked` | `bool` | `false` | Initial checked state |
| `description` | `string` | `''` | Helper text shown below the control |
| `disabled` | `bool` | `false` | Disables the control |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `label` | `string` | `''` | Field label text |
| `required` | `bool` | `false` | Marks the field as required |
| `value` | `string` | `'1'` | Value submitted when checked |
| `size` | `string` | `'default'` | Toggle size (only when `component` is `'toggle'`) |
| `variant` | `string` | `'default'` | Toggle variant (only when `component` is `'toggle'`) |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->checkbox_field ?>
    $this->checkbox_field = new \Theme\Components\CheckboxField(
        label: 'Subscribe to newsletter',
        description: 'You can unsubscribe at any time.',
        required: false,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\CheckboxField(
        label: 'Subscribe to newsletter',
        description: 'You can unsubscribe at any time.',
        required: false,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\CheckboxField(
    label: 'Subscribe to newsletter',
    description: 'You can unsubscribe at any time.',
    required: false,
) ?>
```

### Via global helpers

```php
the_component('checkbox-field', [
    'label'       => 'Subscribe to newsletter',
    'description' => 'You can unsubscribe at any time.',
    'required'    => false,
]);

$html = get_component('checkbox-field', [
    'label'       => 'Subscribe to newsletter',
    'description' => 'You can unsubscribe at any time.',
    'required'    => false,
]);
```

## ACF Fields

Fields are defined in `checkbox_field_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All checkbox-field fields as a single group |
| `label` | `FieldsBuilder` | Label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required true/false field |
| `error` | `FieldsBuilder` | Error message text field |
| `value` | `FieldsBuilder` | Submitted value text field |
| `checked` | `FieldsBuilder` | Initially checked true/false field |
| `disabled` | `FieldsBuilder` | Disabled true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $checkbox_field_fields = require get_stylesheet_directory() . '/components/checkbox-field/checkbox_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($checkbox_field_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $checkbox_field_fields = require get_stylesheet_directory() . '/components/checkbox-field/checkbox_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($checkbox_field_fields['label'])
        ->addFields($checkbox_field_fields['description']);
};
```
