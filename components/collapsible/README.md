# Collapsible

Collapsible content panel with trigger and typography body.

**shadcn/ui:** [Collapsible](https://ui.shadcn.com/docs/components/collapsible)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `trigger_label` | `string` | `''` | Label on the toggle trigger button |
| `body` | `string` | `''` | HTML content shown when expanded |
| `open` | `bool` | `false` | Whether the panel starts open |
| `include_icon` | `bool\|int` | `0` | Whether to render an icon in the trigger |
| `icon_provider` | `string` | `''` | Active icon provider key |
| `icon_lucide_icons` | `string` | `''` | Lucide icon name |
| `icon_image_icon` | `string` | `''` | Image icon value |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->details ?>
    $this->details = new \Theme\Components\Collapsible(
        trigger_label: 'Show more details',
        body: '<p>Here are the additional details.</p>',
        open: false,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Collapsible(
        trigger_label: 'Show more details',
        body: '<p>Here are the additional details.</p>',
        open: false,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Collapsible(
    trigger_label: 'Show more details',
    body: '<p>Here are the additional details.</p>',
    open: false,
) ?>
```

### Via global helpers

```php
the_component('collapsible', [
    'trigger_label' => 'Show more details',
    'body'          => '<p>Here are the additional details.</p>',
    'open'          => false,
]);

$html = get_component('collapsible', [
    'trigger_label' => 'Show more details',
    'body'          => '<p>Here are the additional details.</p>',
    'open'          => false,
]);
```

## ACF Fields

Fields are defined in `collapsible_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All collapsible fields as a single group |
| `trigger_label` | `FieldsBuilder` | Trigger label text field |
| `body` | `FieldsBuilder` | Body content WYSIWYG field |
| `open` | `FieldsBuilder` | Default open true/false field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $collapsible_fields = require get_stylesheet_directory() . '/components/collapsible/collapsible_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($collapsible_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $collapsible_fields = require get_stylesheet_directory() . '/components/collapsible/collapsible_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($collapsible_fields['trigger_label'])
        ->addFields($collapsible_fields['body']);
};
```
