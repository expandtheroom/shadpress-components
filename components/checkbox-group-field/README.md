# Checkbox Group Field

Group of checkboxes sharing a name, submitting selected values as an array.

**shadcn/ui:** [Checkbox](https://ui.shadcn.com/docs/components/checkbox)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `description` | `string` | `''` | Helper text shown below the group |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `label` | `string` | `''` | Group label |
| `options` | `array` | `[]` | Array of option objects. Each: `label` (string), `value` (string) |
| `orientation` | `string` | `'horizontal'` | `'vertical'` or `'horizontal'` |
| `required` | `bool` | `false` | Marks the group as required |
| `variant` | `string` | `'checkbox'` | `'checkbox'` (default) or `'toggle-group'` (renders as toggle buttons) |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->interests ?>
    $this->interests = new \Theme\Components\CheckboxGroupField(
        label: 'Interests',
        options: [
            ['label' => 'Design', 'value' => 'design'],
            ['label' => 'Development', 'value' => 'dev'],
            ['label' => 'Marketing', 'value' => 'marketing'],
        ],
        orientation: 'vertical',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\CheckboxGroupField(
        label: 'Interests',
        options: [
            ['label' => 'Design', 'value' => 'design'],
            ['label' => 'Development', 'value' => 'dev'],
            ['label' => 'Marketing', 'value' => 'marketing'],
        ],
        orientation: 'vertical',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\CheckboxGroupField(
    label: 'Interests',
    options: [
        ['label' => 'Design', 'value' => 'design'],
        ['label' => 'Development', 'value' => 'dev'],
        ['label' => 'Marketing', 'value' => 'marketing'],
    ],
    orientation: 'vertical',
) ?>
```

### Via global helpers

```php
the_component('checkbox-group-field', [
    'label'       => 'Interests',
    'options'     => [
        ['label' => 'Design', 'value' => 'design'],
        ['label' => 'Development', 'value' => 'dev'],
        ['label' => 'Marketing', 'value' => 'marketing'],
    ],
    'orientation' => 'vertical',
]);

$html = get_component('checkbox-group-field', [
    'label'       => 'Interests',
    'options'     => [
        ['label' => 'Design', 'value' => 'design'],
        ['label' => 'Development', 'value' => 'dev'],
        ['label' => 'Marketing', 'value' => 'marketing'],
    ],
    'orientation' => 'vertical',
]);
```

## ACF Fields

Fields are defined in `checkbox_group_field_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All checkbox-group-field fields as a single group |
| `label` | `FieldsBuilder` | Group label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required true/false field |
| `error` | `FieldsBuilder` | Error message text field |
| `options` | `FieldsBuilder` | Options repeater field (label + value per option) |
| `orientation` | `FieldsBuilder` | Orientation select field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $checkbox_group_field_fields = require get_stylesheet_directory() . '/components/checkbox-group-field/checkbox_group_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($checkbox_group_field_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $checkbox_group_field_fields = require get_stylesheet_directory() . '/components/checkbox-group-field/checkbox_group_field_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($checkbox_group_field_fields['label'])
        ->addFields($checkbox_group_field_fields['options']);
};
```
