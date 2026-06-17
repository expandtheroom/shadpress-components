# Button

Versatile button component with multiple variants and sizes.

**shadcn/ui:** [Button](https://ui.shadcn.com/docs/components/button)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `'default'` | Visual style: `'default'`, `'secondary'`, `'outline'`, `'ghost'`, `'link'`, `'destructive'` |
| `size` | `string` | `'default'` | Size: `'xs'`, `'sm'`, `'default'`, `'lg'`, `'icon'`, `'icon-xs'`, `'icon-sm'`, `'icon-lg'` |
| `link` | `array\|string` | `[]` | ACF link array (`url`, `title`, `target`) — renders as `<a>` when set |
| `label` | `string` | `''` | Button label text — renders as `<button>` when `link` is empty |
| `disabled` | `bool\|int` | `0` | Disables the button element |
| `type` | `string` | `'button'` | HTML button type: `'button'`, `'submit'`, `'reset'` |
| `click_action` | `string` | `''` | Set to `'alpine'` to wire an Alpine.js module via `x-data` |
| `alpine_module` | `string` | `''` | Alpine module name (used when `click_action` is `'alpine'`) |
| `include_icon` | `bool\|int` | `0` | Whether to render an icon |
| `icon_provider` | `string` | `''` | Active icon provider key (falls back to first registered) |
| `icon_lucide_icons` | `string` | `''` | Lucide icon name (when provider is `lucide-icons`) |
| `icon_image_icon` | `string` | `''` | Image icon value (when provider is `image-icon`) |
| `icon_position` | `string` | `'left'` | Icon position: `'left'` or `'right'` |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->button ?>
    $this->button = new \Theme\Components\Button(
        variant: 'default',
        link: ['url' => '/contact', 'title' => 'Contact us'],
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Button(
        variant: 'outline',
        label: 'Submit',
        type: 'submit',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Button(
    variant: 'default',
    link: ['url' => '/contact', 'title' => 'Contact us'],
) ?>

<?= new \Theme\Components\Button(
    variant: 'outline',
    label: 'Submit',
    type: 'submit',
) ?>
```

### Via global helpers

```php
the_component('button', [
    'variant' => 'outline',
    'label'   => 'Submit',
    'type'    => 'submit',
]);

$html = get_component('button', [
    'variant' => 'default',
    'link'    => ['url' => '/contact', 'title' => 'Contact us'],
]);
```

## ACF Fields

Fields are defined in `button_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All button fields as a single group |
| `link` | `FieldsBuilder` | Link field (URL, title, target) |
| `label` | `FieldsBuilder` | Label text field |
| `variant` | `FieldsBuilder` | Variant select field |
| `size` | `FieldsBuilder` | Size select field |
| `type` | `FieldsBuilder` | Button type select field |
| `click_action` | `FieldsBuilder` | Click action select field |
| `alpine_module` | `FieldsBuilder` | Alpine module select field |
| `disabled` | `FieldsBuilder` | Disabled true/false field |
| `variant_choices` | `array` | Raw choices array for the variant select |
| `size_choices` | `array` | Raw choices array for the size select |
| `type_choices` | `array` | Raw choices array for the type select |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $button_fields = require get_stylesheet_directory() . '/components/button/button_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($button_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $button_fields = require get_stylesheet_directory() . '/components/button/button_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($button_fields['variant'])
        ->addFields($button_fields['size']);
};
```
