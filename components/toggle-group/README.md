# Toggle Group

Group of toggle buttons with multi-select support. Drop-in replacement for Checkbox Group with toggle button UI.

Composes [Toggle](../toggle/README.md) → [Button](../button/README.md). Variant/size choices are sourced from Toggle, which sources them from Button.

**shadcn/ui:** [toggle-group](https://ui.shadcn.com/docs/components/toggle-group)

## Props

| Prop | Type | Default | Description |
| ---- | ---- | ------- | ----------- |
| `label` | `string` | `''` | Accessible name for the group (`aria-label`) |
| `options` | `array` | `[]` | Array of option objects. Each: `label` (string), `value` (string), `checked` (bool), `disabled` (bool) |
| `orientation` | `string` | `'horizontal'` | Layout direction: `'horizontal'` or `'vertical'` |
| `layout` | `string` | `'conjoined'` | Button arrangement: `'conjoined'` (joined with shared border) or `'separate'` (individual spaced buttons) |
| `multiple` | `bool` | `true` | `true` allows multiple options selected at once; `false` allows only one (radio-style) |
| `variant` | `string` | `'default'` | Button variant for the on-state: `'default'`, `'secondary'`, `'ghost'`, `'outline'`, `'destructive'`, `'link'` |
| `size` | `string` | `'default'` | Button size: `'xs'`, `'sm'`, `'default'`, `'lg'` |
| `description` | `string` | `''` | Helper text below the group |
| `error` | `string` | `''` | Error message; non-empty string triggers error state |
| `required` | `bool` | `false` | Marks the label as required |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

Off-state styling (muted background, muted text) is applied via CSS regardless of variant. The chosen variant's styling shows when a button is toggled on.

## Usage

### In a component class

```php
public function prepare(): void {
    $this->x = new \Theme\Components\ToggleGroup(
        label: 'Text alignment',
        options: [
            ['label' => 'Left',   'value' => 'left',   'checked' => true],
            ['label' => 'Center', 'value' => 'center', 'checked' => false],
            ['label' => 'Right',  'value' => 'right',  'checked' => false],
        ],
        orientation: 'horizontal',
        layout: 'conjoined',
        multiple: false,
        variant: 'default',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\ToggleGroup(
    label: 'Text alignment',
    options: [
        ['label' => 'Left',   'value' => 'left',   'checked' => true],
        ['label' => 'Center', 'value' => 'center', 'checked' => false],
        ['label' => 'Right',  'value' => 'right',  'checked' => false],
    ],
) ?>
```

### Via global helpers

```php
the_component('toggle-group', [
    'label' => 'Text alignment',
    'options' => [
        ['label' => 'Left',   'value' => 'left',   'checked' => true],
        ['label' => 'Center', 'value' => 'center', 'checked' => false],
        ['label' => 'Right',  'value' => 'right',  'checked' => false],
    ],
    'orientation' => 'horizontal',
    'layout'      => 'conjoined',
    'multiple'    => false,
    'variant'     => 'secondary',
]);
```

## ACF Fields

Fields are defined in `toggle_group_fields.php`.

### Available keys

| Key | Type | Description |
| --- | ---- | ----------- |
| `full` | `FieldsBuilder` | All toggle-group fields as a single group |
| `label` | `FieldsBuilder` | Accessible label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required toggle |
| `error` | `FieldsBuilder` | Error message text field |
| `options` | `FieldsBuilder` | Options repeater (label, value, checked-by-default) |
| `orientation` | `FieldsBuilder` | Orientation select field |
| `layout` | `FieldsBuilder` | Layout select field (conjoined / separate) |
| `multiple` | `FieldsBuilder` | Multiple selection toggle |
| `variant` | `FieldsBuilder` | Variant select field (all Button variants) |
| `size` | `FieldsBuilder` | Size select field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $toggle_group_fields = require get_stylesheet_directory() . '/components/toggle-group/toggle_group_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($toggle_group_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $toggle_group_fields = require get_stylesheet_directory() . '/components/toggle-group/toggle_group_fields.php';

    $fields
        ->addFields($toggle_group_fields['label'])
        ->addFields($toggle_group_fields['options'])
        ->addFields($toggle_group_fields['orientation']);
};
```
