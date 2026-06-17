# Typography

Renders rich text/HTML content with variant styling.

**shadcn/ui:** [typography](https://ui.shadcn.com/docs/components/typography)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `body` | `string` | `''` | HTML content to render |
| `variant` | `string` | `'default'` | Typography variant that applies prose styling |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Typography(
        body: '<p>Hello <strong>world</strong>.</p>',
        variant: 'default',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Typography(
        body: '<p>Hello <strong>world</strong>.</p>',
        variant: 'default',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Typography(
    body: '<p>Hello <strong>world</strong>.</p>',
    variant: 'default',
) ?>
```

### Via global helpers

```php
the_component('typography', [
    'body' => '<p>Hello <strong>world</strong>.</p>',
    'variant' => 'default',
]);

$html = get_component('typography', [
    'body' => '<p>Hello <strong>world</strong>.</p>',
    'variant' => 'default',
]);
```

## ACF Fields

Fields are defined in `typography_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All typography fields as a single group |
| `body` | `FieldsBuilder` | Body content WYSIWYG field |
| `variant` | `FieldsBuilder` | Variant select field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $typography_fields = require get_stylesheet_directory() . '/components/typography/typography_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($typography_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $typography_fields = require get_stylesheet_directory() . '/components/typography/typography_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($typography_fields['body'])
        ->addFields($typography_fields['variant']);
};
```
