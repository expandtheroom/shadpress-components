# Select Field

Form field wrapper for native select with label, description, and error handling.

**shadcn/ui:** [native-select](https://ui.shadcn.com/docs/components/native-select)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Field label text |
| `description` | `string` | `''` | Helper text shown below the field |
| `required` | `bool` | `false` | Marks the field as required |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `placeholder` | `string` | `''` | Placeholder option text |
| `options` | `array` | `[]` | Array of option objects. Each: `label` (string), `value` (string) |
| `disabled` | `bool` | `false` | Disables the select |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\SelectField(
        label: 'Country',
        placeholder: 'Select a country',
        options: [
            ['label' => 'Croatia', 'value' => 'hr'],
            ['label' => 'Germany', 'value' => 'de'],
        ],
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\SelectField(
        label: 'Country',
        placeholder: 'Select a country',
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
<?= new \Theme\Components\SelectField(
    label: 'Country',
    placeholder: 'Select a country',
    options: [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    required: true,
) ?>
```

### Via global helpers

```php
the_component('select-field', [
    'label' => 'Country',
    'placeholder' => 'Select a country',
    'options' => [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    'required' => true,
]);

$html = get_component('select-field', [
    'label' => 'Country',
    'placeholder' => 'Select a country',
    'options' => [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    'required' => true,
]);
```

## ACF Fields

Fields are defined in `select_field_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All select-field fields as a single group |
| `label` | `FieldsBuilder` | Label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required true/false field |
| `error` | `FieldsBuilder` | Error message text field |
| `placeholder` | `FieldsBuilder` | Placeholder text field |
| `options` | `FieldsBuilder` | Options repeater field (label + value per option) |
| `disabled` | `FieldsBuilder` | Disabled true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $select_field_fields = require get_stylesheet_directory() . '/components/select-field/select_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($select_field_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $select_field_fields = require get_stylesheet_directory() . '/components/select-field/select_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($select_field_fields['label'])
        ->addFields($select_field_fields['options']);
};
```
