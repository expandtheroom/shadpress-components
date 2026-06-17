# Combobox Field

Searchable dropdown combobox with JSON option rendering.

**shadcn/ui:** [Combobox](https://ui.shadcn.com/docs/components/combobox)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Field label text |
| `placeholder` | `string` | `'Search...'` | Search input placeholder |
| `options` | `array` | `[]` | Array of option objects. Each: `label` (string), `value` (string) |
| `description` | `string` | `''` | Helper text shown below the field |
| `required` | `bool` | `false` | Marks the field as required |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->country ?>
    $this->country = new \Theme\Components\ComboboxField(
        label: 'Country',
        placeholder: 'Search country...',
        options: [
            ['label' => 'Croatia', 'value' => 'hr'],
            ['label' => 'Germany', 'value' => 'de'],
        ],
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\ComboboxField(
        label: 'Country',
        placeholder: 'Search country...',
        options: [
            ['label' => 'Croatia', 'value' => 'hr'],
            ['label' => 'Germany', 'value' => 'de'],
        ],
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\ComboboxField(
    label: 'Country',
    placeholder: 'Search country...',
    options: [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    required: true,
) ?>
```

### Via global helpers

```php
the_component('combobox-field', [
    'label'       => 'Country',
    'placeholder' => 'Search country...',
    'options'     => [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    'required'    => true,
]);

$html = get_component('combobox-field', [
    'label'       => 'Country',
    'placeholder' => 'Search country...',
    'options'     => [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    'required'    => true,
]);
```

## ACF Fields

Fields are defined in `combobox_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All combobox-field fields as a single group |
| `label` | `FieldsBuilder` | Label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required true/false field |
| `error` | `FieldsBuilder` | Error message text field |
| `placeholder` | `FieldsBuilder` | Placeholder text field |
| `options` | `FieldsBuilder` | Options repeater field (label + value per option) |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $combobox_fields = require get_stylesheet_directory() . '/components/combobox-field/combobox_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($combobox_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $combobox_fields = require get_stylesheet_directory() . '/components/combobox-field/combobox_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($combobox_fields['label'])
        ->addFields($combobox_fields['options']);
};
```
