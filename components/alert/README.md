# Alert

Alert component with optional dismissible variant.

**shadcn/ui:** [Alert](https://ui.shadcn.com/docs/components/alert)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | `string` | `''` | Alert heading |
| `description` | `string` | `''` | Alert body text |
| `variant` | `string` | `'default'` | Visual style: `'default'`, `'destructive'` |
| `dismissible` | `bool` | `false` | Whether to show a dismiss button |
| `include_icon` | `bool\|int` | `0` | Whether to render an icon |
| `icon_provider` | `string` | `''` | Active icon provider key |
| `icon_lucide_icons` | `string` | `''` | Lucide icon name (when provider is `lucide-icons`) |
| `icon_image_icon` | `string` | `''` | Image icon value (when provider is `image-icon`) |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->alert ?>
    $this->alert = new \Theme\Components\Alert(
        title: 'Heads up!',
        description: 'This action cannot be undone.',
        variant: 'destructive',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Alert(
        title: 'Heads up!',
        description: 'This action cannot be undone.',
        variant: 'destructive',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Alert(
    title: 'Heads up!',
    description: 'This action cannot be undone.',
    variant: 'destructive',
) ?>
```

### Via global helpers

```php
the_component('alert', [
    'title'       => 'Heads up!',
    'description' => 'This action cannot be undone.',
    'variant'     => 'destructive',
]);

$html = get_component('alert', [
    'title'       => 'Heads up!',
    'description' => 'This action cannot be undone.',
    'variant'     => 'destructive',
]);
```

## ACF Fields

Fields are defined in `alert_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All alert fields as a single group |
| `title` | `FieldsBuilder` | Title text field |
| `description` | `FieldsBuilder` | Description text field |
| `variant` | `FieldsBuilder` | Variant select field |
| `variant_choices` | `array` | Raw choices array for the variant select |
| `dismissible` | `FieldsBuilder` | Dismissible true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $alert_fields = require get_stylesheet_directory() . '/components/alert/alert_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($alert_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $alert_fields = require get_stylesheet_directory() . '/components/alert/alert_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($alert_fields['title'])
        ->addFields($alert_fields['variant']);
};
```
