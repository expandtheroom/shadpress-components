# Toggle

Toggle button built on top of the [Button](../button/README.md) component.

**shadcn/ui:** [toggle](https://ui.shadcn.com/docs/components/toggle)

> **Note:** This is a raw control — it renders only the toggle button with no label, description, or error state. For a complete form field use [`CheckboxField`](../checkbox-field/README.md) (`component: 'toggle'`). For ACF block use, see [`FormField`](../form-field/README.md).

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Visible label text |
| `checked` | `bool` | `false` | Initial pressed/unpressed state |
| `variant` | `string` | `'default'` | Button variant: `'default'`, `'secondary'`, `'outline'`, `'ghost'`, `'link'`, `'destructive'` |
| `size` | `string` | `'default'` | Button size: `'xs'`, `'sm'`, `'default'`, `'lg'` |
| `disabled` | `bool` | `false` | Disables the toggle |
| `required` | `bool` | `false` | Marks the field as required |
| `name` | `string` | `''` | HTML `name` attribute |
| `value` | `string` | `'1'` | Value submitted when pressed |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Toggle(
        label: 'Bold',
        variant: 'outline',
        size: 'sm',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Toggle(
        label: 'Bold',
        variant: 'outline',
        size: 'sm',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Toggle(
    label: 'Bold',
    variant: 'outline',
    size: 'sm',
) ?>
```

### Via global helpers

```php
the_component('toggle', [
    'label' => 'Bold',
    'variant' => 'outline',
    'size' => 'sm',
]);

$html = get_component('toggle', [
    'label' => 'Bold',
    'variant' => 'outline',
    'size' => 'sm',
]);
```

## ACF Fields

Fields are defined in `toggle_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All toggle fields as a single group |
| `label` | `FieldsBuilder` | Label text field |
| `checked` | `FieldsBuilder` | Initially checked true/false field |
| `disabled` | `FieldsBuilder` | Disabled true/false field |
| `variant` | `FieldsBuilder` | Variant select field |
| `size` | `FieldsBuilder` | Size select field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $toggle_fields = require get_stylesheet_directory() . '/components/toggle/toggle_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($toggle_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $toggle_fields = require get_stylesheet_directory() . '/components/toggle/toggle_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($toggle_fields['label'])
        ->addFields($toggle_fields['variant']);
};
```
