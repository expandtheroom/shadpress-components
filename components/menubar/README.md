# Menubar

Menu bar for top-level navigation menus with hierarchical items.

**shadcn/ui:** [menubar](https://ui.shadcn.com/docs/components/menubar)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Accessible label for the menubar (`aria-label`) |
| `menus` | `array` | `[]` | Array of menu objects. Each: `label` (string), `menu_items` (array of items). Each item: `type` (string: `'item'`, `'label'`, `'separator'`), `label` (string, for `label` type), `link` (ACF link array with `url`/`title`/`target`, for `item` type) |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->x = new \Theme\Components\Menubar(
        label: 'Main navigation',
        menus: [
            [
                'label' => 'File',
                'menu_items' => [
                    ['type' => 'item', 'link' => ['url' => '/new', 'title' => 'New']],
                    ['type' => 'separator'],
                    ['type' => 'item', 'link' => ['url' => '/exit', 'title' => 'Exit']],
                ],
            ],
        ],
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Menubar(
        label: 'Main navigation',
        menus: [
            [
                'label' => 'File',
                'menu_items' => [
                    ['type' => 'item', 'link' => ['url' => '/new', 'title' => 'New']],
                    ['type' => 'separator'],
                    ['type' => 'item', 'link' => ['url' => '/exit', 'title' => 'Exit']],
                ],
            ],
        ],
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Menubar(
    label: 'Main navigation',
    menus: [
        [
            'label' => 'File',
            'items' => [
                ['type' => 'item', 'label' => 'New', 'url' => '/new'],
                ['type' => 'separator'],
                ['type' => 'item', 'label' => 'Exit', 'url' => '/exit'],
            ],
        ],
    ],
) ?>
```

### Via global helpers

```php
the_component('menubar', [
    'label' => 'Main navigation',
    'menus' => [
        [
            'label' => 'File',
            'items' => [
                ['type' => 'item', 'label' => 'New', 'url' => '/new'],
                ['type' => 'separator'],
                ['type' => 'item', 'label' => 'Exit', 'url' => '/exit'],
            ],
        ],
    ],
]);

$html = get_component('menubar', [
    'label' => 'Main navigation',
    'menus' => [
        [
            'label' => 'File',
            'items' => [
                ['type' => 'item', 'label' => 'New', 'url' => '/new'],
                ['type' => 'separator'],
                ['type' => 'item', 'label' => 'Exit', 'url' => '/exit'],
            ],
        ],
    ],
]);
```

## ACF Fields

Fields are defined in `menubar_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All menubar fields as a single group |
| `label` | `FieldsBuilder` | Accessible label text field |
| `menus` | `FieldsBuilder` | Menus repeater field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $menubar_fields = require get_stylesheet_directory() . '/components/menubar/menubar_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($menubar_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $menubar_fields = require get_stylesheet_directory() . '/components/menubar/menubar_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($menubar_fields['label'])
        ->addFields($menubar_fields['menus']);
};
```
