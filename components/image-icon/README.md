# ImageIcon

Icon provider component for image-based icons.

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `icon` | `string` | `''` | Image URL for the icon |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->icon = new \Theme\Components\ImageIcon(
        icon: 'https://example.com/icons/star.svg',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\ImageIcon(
        icon: 'https://example.com/icons/star.svg',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\ImageIcon(
    icon: 'https://example.com/icons/star.svg',
) ?>
```

### Via global helpers

```php
the_component('image-icon', [
    'icon' => 'https://example.com/icons/star.svg',
]);

$html = get_component('image-icon', [
    'icon' => 'https://example.com/icons/star.svg',
]);
```

## ACF Fields

Fields are defined in `image_icon_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All image-icon fields as a single group |
| `icon` | `FieldsBuilder` | Image field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $image_icon_fields = require get_stylesheet_directory() . '/components/image-icon/image_icon_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($image_icon_fields['full']);
};
```
