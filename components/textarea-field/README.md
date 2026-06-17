# Textarea Field

Form field wrapper for textarea with label, description, and error handling.

**shadcn/ui:** [textarea](https://ui.shadcn.com/docs/components/textarea)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Field label text |
| `description` | `string` | `''` | Helper text shown below the field |
| `required` | `bool` | `false` | Marks the field as required |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `placeholder` | `string` | `''` | Placeholder text |
| `rows` | `int` | `4` | Number of visible text rows |
| `disabled` | `bool` | `false` | Disables the textarea |
| `readonly` | `bool` | `false` | Makes the textarea read-only |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\TextareaField(
        label: 'Message',
        placeholder: 'Write your message...',
        rows: 6,
        required: true,
        description: 'Maximum 500 characters.',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\TextareaField(
        label: 'Message',
        placeholder: 'Write your message...',
        rows: 6,
        required: true,
        description: 'Maximum 500 characters.',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\TextareaField(
    label: 'Message',
    placeholder: 'Write your message...',
    rows: 6,
    required: true,
    description: 'Maximum 500 characters.',
) ?>
```

### Via global helpers

```php
the_component('textarea-field', [
    'label' => 'Message',
    'placeholder' => 'Write your message...',
    'rows' => 6,
    'required' => true,
    'description' => 'Maximum 500 characters.',
]);

$html = get_component('textarea-field', [
    'label' => 'Message',
    'placeholder' => 'Write your message...',
    'rows' => 6,
    'required' => true,
    'description' => 'Maximum 500 characters.',
]);
```

## ACF Fields

Fields are defined in `textarea_field_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All textarea-field fields as a single group |
| `label` | `FieldsBuilder` | Label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required true/false field |
| `error` | `FieldsBuilder` | Error message text field |
| `placeholder` | `FieldsBuilder` | Placeholder text field |
| `rows` | `FieldsBuilder` | Rows number field |
| `disabled` | `FieldsBuilder` | Disabled true/false field |
| `readonly` | `FieldsBuilder` | Read-only true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $textarea_field_fields = require get_stylesheet_directory() . '/components/textarea-field/textarea_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($textarea_field_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $textarea_field_fields = require get_stylesheet_directory() . '/components/textarea-field/textarea_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($textarea_field_fields['label'])
        ->addFields($textarea_field_fields['description']);
};
```
