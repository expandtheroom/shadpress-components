# StyledSelectField

Custom styled select dropdown with label, description, and error handling.

**shadcn/ui:** [select](https://ui.shadcn.com/docs/components/select)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Field label text |
| `placeholder` | `string` | `'Select an option'` | Placeholder text shown when no option is selected |
| `options` | `array` | `[]` | Array of option objects. Each: `label` (string), `value` (string) |
| `disabled` | `bool` | `false` | Disables the select |
| `description` | `string` | `''` | Helper text shown below the field |
| `required` | `bool` | `false` | Marks the field as required |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\StyledSelectField(
        label: 'Framework',
        placeholder: 'Select a framework',
        options: [
            ['label' => 'React', 'value' => 'react'],
            ['label' => 'Vue', 'value' => 'vue'],
        ],
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\StyledSelectField(
        label: 'Framework',
        placeholder: 'Select a framework',
        options: [
            ['label' => 'React', 'value' => 'react'],
            ['label' => 'Vue', 'value' => 'vue'],
        ],
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\StyledSelectField(
    label: 'Framework',
    placeholder: 'Select a framework',
    options: [
        ['label' => 'React', 'value' => 'react'],
        ['label' => 'Vue', 'value' => 'vue'],
    ],
    required: true,
) ?>
```

### Via global helpers

```php
the_component('styled-select-field', [
    'label' => 'Framework',
    'placeholder' => 'Select a framework',
    'options' => [
        ['label' => 'React', 'value' => 'react'],
        ['label' => 'Vue', 'value' => 'vue'],
    ],
    'required' => true,
]);

$html = get_component('styled-select-field', [
    'label' => 'Framework',
    'placeholder' => 'Select a framework',
    'options' => [
        ['label' => 'React', 'value' => 'react'],
        ['label' => 'Vue', 'value' => 'vue'],
    ],
    'required' => true,
]);
```

## ACF Fields

Fields are defined in `styled_select_field_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All styled-select-field fields as a single group |
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
    $styled_select_field_fields = require get_stylesheet_directory() . '/components/styled-select-field/styled_select_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($styled_select_field_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $styled_select_field_fields = require get_stylesheet_directory() . '/components/styled-select-field/styled_select_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($styled_select_field_fields['label'])
        ->addFields($styled_select_field_fields['description'])
        ->addFields($styled_select_field_fields['required']);
};
```
