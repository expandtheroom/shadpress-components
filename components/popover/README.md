# Popover

Floating popover with content, positioning, and alignment options.

**shadcn/ui:** [popover](https://ui.shadcn.com/docs/components/popover)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `trigger_label` | `string` | `''` | Trigger button label |
| `trigger_variant` | `string` | `'outline'` | Trigger button variant: `'default'`, `'secondary'`, `'outline'`, `'ghost'`, `'link'`, `'destructive'` |
| `body` | `string` | `''` | HTML content inside the popover |
| `side` | `string` | `'bottom'` | Popover position: `'top'`, `'right'`, `'bottom'`, `'left'` |
| `align` | `string` | `'center'` | Popover alignment: `'start'`, `'center'`, `'end'` |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Popover(
        trigger_label: 'Open popover',
        body: '<p>Popover content goes here.</p>',
        side: 'bottom',
        align: 'start',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Popover(
        trigger_label: 'Open popover',
        body: '<p>Popover content goes here.</p>',
        side: 'bottom',
        align: 'start',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Popover(
    trigger_label: 'Open popover',
    body: '<p>Popover content goes here.</p>',
    side: 'bottom',
    align: 'start',
) ?>
```

### Via global helpers

```php
the_component('popover', [
    'trigger_label' => 'Open popover',
    'body' => '<p>Popover content goes here.</p>',
    'side' => 'bottom',
    'align' => 'start',
]);

$html = get_component('popover', [
    'trigger_label' => 'Open popover',
    'body' => '<p>Popover content goes here.</p>',
    'side' => 'bottom',
    'align' => 'start',
]);
```

## ACF Fields

Fields are defined in `popover_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All popover fields as a single group |
| `trigger_label` | `FieldsBuilder` | Trigger button label text field |
| `trigger_variant` | `FieldsBuilder` | Trigger button variant select field |
| `trigger_variant_choices` | `array` | Variant choices array |
| `body` | `FieldsBuilder` | Body content WYSIWYG field |
| `side` | `FieldsBuilder` | Side select field |
| `side_choices` | `array` | Side choices array |
| `align` | `FieldsBuilder` | Alignment select field |
| `align_choices` | `array` | Align choices array |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $popover_fields = require get_stylesheet_directory() . '/components/popover/popover_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($popover_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $popover_fields = require get_stylesheet_directory() . '/components/popover/popover_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($popover_fields['trigger_label'])
        ->addFields($popover_fields['body'])
        ->addFields($popover_fields['side'])
        ->addFields($popover_fields['align']);
};
```
