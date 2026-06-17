# Tooltip

Floating tooltip with configurable side and alignment.

**shadcn/ui:** [tooltip](https://ui.shadcn.com/docs/components/tooltip)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `trigger_label` | `string` | `''` | Visible trigger element text |
| `tooltip_content` | `string` | `''` | Tooltip text content |
| `side` | `string` | `'top'` | Tooltip position: `'top'`, `'right'`, `'bottom'`, `'left'` |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Tooltip(
        trigger_label: 'Hover me',
        tooltip_content: 'This is a tooltip.',
        side: 'top',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Tooltip(
        trigger_label: 'Hover me',
        tooltip_content: 'This is a tooltip.',
        side: 'top',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Tooltip(
    trigger_label: 'Hover me',
    tooltip_content: 'This is a tooltip.',
    side: 'top',
) ?>
```

### Via global helpers

```php
the_component('tooltip', [
    'trigger_label' => 'Hover me',
    'tooltip_content' => 'This is a tooltip.',
    'side' => 'top',
]);

$html = get_component('tooltip', [
    'trigger_label' => 'Hover me',
    'tooltip_content' => 'This is a tooltip.',
    'side' => 'top',
]);
```

## ACF Fields

Fields are defined in `tooltip_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All tooltip fields as a single group |
| `trigger_label` | `FieldsBuilder` | Trigger label text field |
| `content` | `FieldsBuilder` | Tooltip content text field |
| `side` | `FieldsBuilder` | Side select field |
| `side_choices` | `array` | Raw choices array for the side select |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $tooltip_fields = require get_stylesheet_directory() . '/components/tooltip/tooltip_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($tooltip_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $tooltip_fields = require get_stylesheet_directory() . '/components/tooltip/tooltip_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($tooltip_fields['trigger_label'])
        ->addFields($tooltip_fields['side']);
};
```
