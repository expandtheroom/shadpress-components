# Separator

Visual separator line with horizontal/vertical orientation.

**shadcn/ui:** [separator](https://ui.shadcn.com/docs/components/separator)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `orientation` | `string` | `'horizontal'` | `'horizontal'` or `'vertical'` |
| `decorative` | `bool` | `true` | When `true`, sets `aria-hidden="true"` (purely visual); `false` for semantic separators |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Separator(
        orientation: 'horizontal',
        decorative: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Separator(
        orientation: 'horizontal',
        decorative: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Separator(
    orientation: 'horizontal',
    decorative: true,
) ?>
```

### Via global helpers

```php
the_component('separator', [
    'orientation' => 'horizontal',
    'decorative' => true,
]);

$html = get_component('separator', [
    'orientation' => 'horizontal',
    'decorative' => true,
]);
```

## ACF Fields

Fields are defined in `separator_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All separator fields as a single group |
| `orientation` | `FieldsBuilder` | Orientation select field |
| `decorative` | `FieldsBuilder` | Decorative true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $separator_fields = require get_stylesheet_directory() . '/components/separator/separator_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($separator_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $separator_fields = require get_stylesheet_directory() . '/components/separator/separator_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($separator_fields['orientation'])
        ->addFields($separator_fields['decorative']);
};
```
