# Textarea

Multi-line text input field with configurable rows.

**shadcn/ui:** [textarea](https://ui.shadcn.com/docs/components/textarea)

> **Note:** This is a raw control — it renders only the `<textarea>` element with no label, description, or error state. For a complete form field use [`TextareaField`](../textarea-field/README.md). For ACF block use, see [`FormField`](../form-field/README.md).

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | `string` | `''` | HTML `name` attribute |
| `id` | `string` | `''` | HTML `id` attribute |
| `placeholder` | `string` | `''` | Placeholder text |
| `rows` | `int` | `4` | Number of visible text rows |
| `required` | `bool` | `false` | Marks the field as required |
| `disabled` | `bool` | `false` | Disables the textarea |
| `readonly` | `bool` | `false` | Makes the textarea read-only |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Textarea(
        name: 'message',
        id: 'message',
        placeholder: 'Write your message...',
        rows: 6,
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Textarea(
        name: 'message',
        id: 'message',
        placeholder: 'Write your message...',
        rows: 6,
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Textarea(
    name: 'message',
    id: 'message',
    placeholder: 'Write your message...',
    rows: 6,
    required: true,
) ?>
```

### Via global helpers

```php
the_component('textarea', [
    'name' => 'message',
    'id' => 'message',
    'placeholder' => 'Write your message...',
    'rows' => 6,
    'required' => true,
]);

$html = get_component('textarea', [
    'name' => 'message',
    'id' => 'message',
    'placeholder' => 'Write your message...',
    'rows' => 6,
    'required' => true,
]);
```

## ACF Fields

Fields are defined in `textarea_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All textarea fields as a single group |
| `name` | `FieldsBuilder` | Name text field |
| `id` | `FieldsBuilder` | ID text field |
| `placeholder` | `FieldsBuilder` | Placeholder text field |
| `rows` | `FieldsBuilder` | Rows number field |
| `required` | `FieldsBuilder` | Required true/false field |
| `disabled` | `FieldsBuilder` | Disabled true/false field |
| `readonly` | `FieldsBuilder` | Read-only true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $textarea_fields = require get_stylesheet_directory() . '/components/textarea/textarea_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($textarea_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $textarea_fields = require get_stylesheet_directory() . '/components/textarea/textarea_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($textarea_fields['name'])
        ->addFields($textarea_fields['placeholder'])
        ->addFields($textarea_fields['rows']);
};
```
