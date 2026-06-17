# Radio Group Field

Radio button group with multiple options and orientation control.

**shadcn/ui:** [radio-group](https://ui.shadcn.com/docs/components/radio-group)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Group label text |
| `options` | `array` | `[]` | Array of option objects. Each: `label` (string), `value` (string) |
| `default_value` | `string` | `''` | Value of the pre-selected option |
| `disabled` | `bool` | `false` | Disables all options |
| `orientation` | `string` | `'horizontal'` | `'vertical'` or `'horizontal'` |
| `description` | `string` | `''` | Helper text shown below the group |
| `required` | `bool` | `false` | Marks the group as required |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\RadioGroupField(
        label: 'Preferred contact method',
        options: [
            ['label' => 'Email', 'value' => 'email'],
            ['label' => 'Phone', 'value' => 'phone'],
        ],
        default_value: 'email',
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\RadioGroupField(
        label: 'Preferred contact method',
        options: [
            ['label' => 'Email', 'value' => 'email'],
            ['label' => 'Phone', 'value' => 'phone'],
        ],
        default_value: 'email',
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\RadioGroupField(
    label: 'Preferred contact method',
    options: [
        ['label' => 'Email', 'value' => 'email'],
        ['label' => 'Phone', 'value' => 'phone'],
    ],
    default_value: 'email',
    required: true,
) ?>
```

### Via global helpers

```php
the_component('radio-group-field', [
    'label' => 'Preferred contact method',
    'options' => [
        ['label' => 'Email', 'value' => 'email'],
        ['label' => 'Phone', 'value' => 'phone'],
    ],
    'default_value' => 'email',
    'required' => true,
]);

$html = get_component('radio-group-field', [
    'label' => 'Preferred contact method',
    'options' => [
        ['label' => 'Email', 'value' => 'email'],
        ['label' => 'Phone', 'value' => 'phone'],
    ],
    'default_value' => 'email',
    'required' => true,
]);
```

## ACF Fields

Fields are defined in `radio_group_field_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All radio-group-field fields as a single group |
| `label` | `FieldsBuilder` | Group label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required true/false field |
| `error` | `FieldsBuilder` | Error message text field |
| `options` | `FieldsBuilder` | Options repeater field (label + value per option) |
| `default_value` | `FieldsBuilder` | Default value text field |
| `disabled` | `FieldsBuilder` | Disabled true/false field |
| `orientation` | `FieldsBuilder` | Orientation select field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $radio_group_field_fields = require get_stylesheet_directory() . '/components/radio-group-field/radio_group_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($radio_group_field_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $radio_group_field_fields = require get_stylesheet_directory() . '/components/radio-group-field/radio_group_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($radio_group_field_fields['label'])
        ->addFields($radio_group_field_fields['options']);
};
```
