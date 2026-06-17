# Badge

Inline badge with various styling variants.

**shadcn/ui:** [Badge](https://ui.shadcn.com/docs/components/badge)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Badge text |
| `variant` | `string` | `'default'` | Visual style: `'default'`, `'secondary'`, `'outline'`, `'destructive'` |
| `include_icon` | `bool\|int` | `0` | Whether to render an icon |
| `icon_provider` | `string` | `''` | Active icon provider key |
| `icon_lucide_icons` | `string` | `''` | Lucide icon name (when provider is `lucide-icons`) |
| `icon_image_icon` | `string` | `''` | Image icon value (when provider is `image-icon`) |
| `icon_position` | `string` | `'left'` | Icon position: `'left'` or `'right'` |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->badge ?>
    $this->badge = new \Theme\Components\Badge(
        label: 'New',
        variant: 'secondary',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Badge(
        label: 'New',
        variant: 'secondary',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Badge(
    label: 'New',
    variant: 'secondary',
) ?>
```

### Via global helpers

```php
the_component('badge', [
    'label'   => 'New',
    'variant' => 'secondary',
]);

$html = get_component('badge', [
    'label'   => 'New',
    'variant' => 'secondary',
]);
```

## ACF Fields

Fields are defined in `badge_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All badge fields as a single group |
| `label` | `FieldsBuilder` | Badge label text field |
| `variant` | `FieldsBuilder` | Variant select field |
| `variant_choices` | `array` | Raw choices array for the variant select |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $badge_fields = require get_stylesheet_directory() . '/components/badge/badge_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($badge_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $badge_fields = require get_stylesheet_directory() . '/components/badge/badge_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($badge_fields['label'])
        ->addFields($badge_fields['variant']);
};
```
