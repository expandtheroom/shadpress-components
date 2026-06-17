# Dropdown Menu

Dropdown menu with items, labels, and separator support.

**shadcn/ui:** [dropdown-menu](https://ui.shadcn.com/docs/components/dropdown-menu)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `trigger_label` | `string` | `''` | Trigger button label |
| `trigger_variant` | `string` | `'default'` | Trigger button variant |
| `menu_items` | `array` | `[]` | Array of menu item objects. Each: `label` (string), `href` (string, optional), `type` (string: `'item'`, `'label'`, `'separator'`) |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->menu ?>
    $this->menu = new \Theme\Components\DropdownMenu(
        trigger_label: 'Open menu',
        menu_items: [
            ['type' => 'item', 'label' => 'Profile', 'href' => '/profile'],
            ['type' => 'item', 'label' => 'Settings', 'href' => '/settings'],
            ['type' => 'separator'],
            ['type' => 'item', 'label' => 'Logout', 'href' => '/logout'],
        ],
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\DropdownMenu(
        trigger_label: 'Open menu',
        menu_items: [
            ['type' => 'item', 'label' => 'Profile', 'href' => '/profile'],
            ['type' => 'item', 'label' => 'Settings', 'href' => '/settings'],
            ['type' => 'separator'],
            ['type' => 'item', 'label' => 'Logout', 'href' => '/logout'],
        ],
    );
}
```

### In a template file

```php
<?= new \Theme\Components\DropdownMenu(
    trigger_label: 'Open menu',
    menu_items: [
        ['type' => 'item', 'label' => 'Profile', 'href' => '/profile'],
        ['type' => 'item', 'label' => 'Settings', 'href' => '/settings'],
        ['type' => 'separator'],
        ['type' => 'item', 'label' => 'Logout', 'href' => '/logout'],
    ],
) ?>
```

### Via global helpers

```php
the_component('dropdown-menu', [
    'trigger_label' => 'Open menu',
    'menu_items' => [
        ['type' => 'item', 'label' => 'Profile', 'href' => '/profile'],
        ['type' => 'item', 'label' => 'Settings', 'href' => '/settings'],
        ['type' => 'separator'],
        ['type' => 'item', 'label' => 'Logout', 'href' => '/logout'],
    ],
]);

$html = get_component('dropdown-menu', [
    'trigger_label' => 'Open menu',
    'menu_items' => [
        ['type' => 'item', 'label' => 'Profile', 'href' => '/profile'],
        ['type' => 'item', 'label' => 'Settings', 'href' => '/settings'],
        ['type' => 'separator'],
        ['type' => 'item', 'label' => 'Logout', 'href' => '/logout'],
    ],
]);
```

## ACF Fields

Fields are defined in `dropdown_menu_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All dropdown-menu fields as a single group |
| `trigger_label` | `FieldsBuilder` | Trigger button label text field |
| `trigger_variant` | `FieldsBuilder` | Trigger button variant select field |
| `menu_items` | `FieldsBuilder` | Menu items repeater field |
| `trigger_variant_choices` | `array` | Trigger variant choices array |
| `item_type_choices` | `array` | Menu item type choices array |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $dropdown_menu_fields = require get_stylesheet_directory() . '/components/dropdown-menu/dropdown_menu_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($dropdown_menu_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $dropdown_menu_fields = require get_stylesheet_directory() . '/components/dropdown-menu/dropdown_menu_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($dropdown_menu_fields['trigger_label'])
        ->addFields($dropdown_menu_fields['menu_items']);
};
```
