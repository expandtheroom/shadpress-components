# Label

Form label element with optional required indicator.

**shadcn/ui:** [label](https://ui.shadcn.com/docs/components/label)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `text` | `string` | `''` | Label text |
| `label_for` | `string` | `''` | HTML `for` attribute — associates the label with an input `id` |
| `required` | `bool` | `false` | Whether to show the required indicator |
| `id` | `string` | `''` | HTML `id` attribute on the label element |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->email_label = new \Theme\Components\Label(
        text: 'Email address',
        label_for: 'user-email',
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Label(
        text: 'Email address',
        label_for: 'user-email',
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Label(
    text: 'Email address',
    label_for: 'user-email',
    required: true,
) ?>
```

### Via global helpers

```php
the_component('label', [
    'text' => 'Email address',
    'label_for' => 'user-email',
    'required' => true,
]);

$html = get_component('label', [
    'text' => 'Email address',
    'label_for' => 'user-email',
    'required' => true,
]);
```

## ACF Fields

Fields are defined in `label_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All label fields as a single group |
| `text` | `FieldsBuilder` | Label text field |
| `label_for` | `FieldsBuilder` | For attribute text field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $label_fields = require get_stylesheet_directory() . '/components/label/label_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($label_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $label_fields = require get_stylesheet_directory() . '/components/label/label_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($label_fields['text'])
        ->addFields($label_fields['label_for']);
};
```
