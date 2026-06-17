# Lucide Icons

Lucide icon library provider — renders SVG icons by name.

**See:** [lucide.dev/icons](https://lucide.dev/icons)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `icon_name` | `string` | `''` | Lucide icon name (e.g. `'circle-check'`, `'x'`, `'star'`) |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\LucideIcons(
        icon_name: 'circle-check',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\LucideIcons(
        icon_name: 'circle-check',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\LucideIcons(
    icon_name: 'circle-check',
) ?>
```

### Via global helpers

```php
the_component('lucide-icons', [
    'icon_name' => 'circle-check',
]);

$html = get_component('lucide-icons', [
    'icon_name' => 'circle-check',
]);
```

## ACF Fields

Fields are defined in `lucide_icon_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All lucide-icons fields as a single group |
| `icon_name` | `FieldsBuilder` | Icon name picker field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $lucide_icons_fields = require get_stylesheet_directory() . '/components/lucide-icons/lucide_icon_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($lucide_icons_fields['full']);
};
```
