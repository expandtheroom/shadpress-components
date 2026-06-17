# Scroll Area

Scrollable container with typography content and max-height control.

**shadcn/ui:** [scroll-area](https://ui.shadcn.com/docs/components/scroll-area)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `body` | `string` | `''` | HTML content inside the scroll area |
| `max_height` | `string` | `'300px'` | CSS max-height value (e.g. `'400px'`, `'50vh'`) |
| `orientation` | `string` | `'vertical'` | Scroll direction: `'vertical'`, `'horizontal'`, or `'both'` |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\ScrollArea(
        body: '<p>Long scrollable content goes here...</p>',
        max_height: '400px',
        orientation: 'vertical',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\ScrollArea(
        body: '<p>Long scrollable content goes here...</p>',
        max_height: '400px',
        orientation: 'vertical',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\ScrollArea(
    body: '<p>Long scrollable content goes here...</p>',
    max_height: '400px',
    orientation: 'vertical',
) ?>
```

### Via global helpers

```php
the_component('scroll-area', [
    'body' => '<p>Long scrollable content goes here...</p>',
    'max_height' => '400px',
    'orientation' => 'vertical',
]);

$html = get_component('scroll-area', [
    'body' => '<p>Long scrollable content goes here...</p>',
    'max_height' => '400px',
    'orientation' => 'vertical',
]);
```

## ACF Fields

Fields are defined in `scroll_area_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All scroll-area fields as a single group |
| `body` | `FieldsBuilder` | Body content WYSIWYG field |
| `max_height` | `FieldsBuilder` | Max height text field |
| `orientation` | `FieldsBuilder` | Orientation select field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $scroll_area_fields = require get_stylesheet_directory() . '/components/scroll-area/scroll_area_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($scroll_area_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $scroll_area_fields = require get_stylesheet_directory() . '/components/scroll-area/scroll_area_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($scroll_area_fields['body'])
        ->addFields($scroll_area_fields['max_height']);
};
```
