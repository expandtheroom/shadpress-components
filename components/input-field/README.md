# InputField

Form field wrapper for input with label, description, and error handling.

**shadcn/ui:** [input](https://ui.shadcn.com/docs/components/input)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Field label text |
| `description` | `string` | `''` | Helper text shown below the field |
| `required` | `bool` | `false` | Marks the field as required |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `field_type` | `string` | `'text'` | HTML input type: `'text'`, `'email'`, `'password'`, `'number'`, `'tel'`, `'url'`, `'search'` |
| `placeholder` | `string` | `''` | Placeholder text |
| `prefix` | `string` | `''` | Text shown before the input (e.g. `'$'`) — triggers input-group styling |
| `suffix` | `string` | `''` | Text shown after the input (e.g. `'.com'`) — triggers input-group styling |
| `disabled` | `bool` | `false` | Disables the input |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->email_field = new \Theme\Components\InputField(
        label: 'Email address',
        field_type: 'email',
        placeholder: 'you@example.com',
        required: true,
        description: 'We will never share your email.',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\InputField(
        label: 'Email address',
        field_type: 'email',
        placeholder: 'you@example.com',
        required: true,
        description: 'We will never share your email.',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\InputField(
    label: 'Email address',
    field_type: 'email',
    placeholder: 'you@example.com',
    required: true,
    description: 'We will never share your email.',
) ?>
```

### Via global helpers

```php
the_component('input-field', [
    'label' => 'Email address',
    'field_type' => 'email',
    'placeholder' => 'you@example.com',
    'required' => true,
    'description' => 'We will never share your email.',
]);

$html = get_component('input-field', [
    'label' => 'Email address',
    'field_type' => 'email',
    'placeholder' => 'you@example.com',
    'required' => true,
    'description' => 'We will never share your email.',
]);
```

## ACF Fields

Fields are defined in `input_field_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All input-field fields as a single group |
| `label` | `FieldsBuilder` | Label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required true/false field |
| `error` | `FieldsBuilder` | Error message text field |
| `field_type` | `FieldsBuilder` | Input type select field |
| `field_type_choices` | `array` | Raw choices array for the input type select |
| `placeholder` | `FieldsBuilder` | Placeholder text field |
| `prefix` | `FieldsBuilder` | Prefix addon text field |
| `suffix` | `FieldsBuilder` | Suffix addon text field |
| `disabled` | `FieldsBuilder` | Disabled true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $input_field_fields = require get_stylesheet_directory() . '/components/input-field/input_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($input_field_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $input_field_fields = require get_stylesheet_directory() . '/components/input-field/input_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($input_field_fields['label'])
        ->addFields($input_field_fields['placeholder'])
        ->addFields($input_field_fields['required']);
};
```
