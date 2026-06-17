# Tabs

Tab interface with multiple panels containing typography content.

**shadcn/ui:** [tabs](https://ui.shadcn.com/docs/components/tabs)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `tabs` | `array` | `[]` | Array of tab objects. Each: `label` (string, tab trigger text), `content` (string, HTML panel content) |
| `icon_provider` | `string` | `''` | Active icon provider key for tab icons |
| `icon_position` | `string` | `'left'` | Icon position relative to tab label: `'left'` or `'right'` |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Tabs(
        tabs: [
            ['label' => 'Account', 'content' => '<p>Account settings go here.</p>'],
            ['label' => 'Password', 'content' => '<p>Password settings go here.</p>'],
        ],
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Tabs(
        tabs: [
            ['label' => 'Account', 'content' => '<p>Account settings go here.</p>'],
            ['label' => 'Password', 'content' => '<p>Password settings go here.</p>'],
        ],
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Tabs(
    tabs: [
        ['label' => 'Account', 'content' => '<p>Account settings go here.</p>'],
        ['label' => 'Password', 'content' => '<p>Password settings go here.</p>'],
    ],
) ?>
```

### Via global helpers

```php
the_component('tabs', [
    'tabs' => [
        ['label' => 'Account', 'content' => '<p>Account settings go here.</p>'],
        ['label' => 'Password', 'content' => '<p>Password settings go here.</p>'],
    ],
]);

$html = get_component('tabs', [
    'tabs' => [
        ['label' => 'Account', 'content' => '<p>Account settings go here.</p>'],
        ['label' => 'Password', 'content' => '<p>Password settings go here.</p>'],
    ],
]);
```

## ACF Fields

Fields are defined in `tabs_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All tabs fields as a single group |
| `tabs` | `FieldsBuilder` | Tabs repeater field (label + content per tab) |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $tabs_fields = require get_stylesheet_directory() . '/components/tabs/tabs_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($tabs_fields['full']);
};
```
