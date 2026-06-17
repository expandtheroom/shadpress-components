# Pagination

WordPress pagination links with previous/next navigation.

**shadcn/ui:** [pagination](https://ui.shadcn.com/docs/components/pagination)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `mid_size` | `int` | `2` | Number of page links to show on each side of the current page |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Pagination(
        mid_size: 2,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Pagination(
        mid_size: 2,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Pagination(
    mid_size: 2,
) ?>
```

### Via global helpers

```php
the_component('pagination', [
    'mid_size' => 2,
]);

$html = get_component('pagination', [
    'mid_size' => 2,
]);
```

## ACF Fields

Fields are defined in `pagination_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All pagination fields as a single group |
| `mid_size` | `FieldsBuilder` | Mid size number field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $pagination_fields = require get_stylesheet_directory() . '/components/pagination/pagination_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($pagination_fields['full']);
};
```
