# Button Group

Group of buttons with orientation, spacing, and alignment options.

**shadcn/ui:** [Button Group](https://ui.shadcn.com/docs/components/radix/button-group)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `orientation` | `string` | `'horizontal'` | `'horizontal'` or `'vertical'` |
| `spacing` | `string` | `'conjoined'` | Button spacing: `'conjoined'` (no gap) or `'loose'` (with gap) |
| `size` | `string` | `'default'` | Size applied to all buttons: `'xs'`, `'sm'`, `'default'`, `'lg'` |
| `buttons` | `array` | `[]` | Array of button data arrays (same shape as Button props) |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->buttonGroup ?>
    $this->buttonGroup = new \Theme\Components\ButtonGroup(
        orientation: 'horizontal',
        spacing: 'conjoined',
        buttons: [
            ['label' => 'One', 'type' => 'button', 'variant' => 'outline'],
            ['label' => 'Two', 'type' => 'button', 'variant' => 'outline'],
        ],
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\ButtonGroup(
        orientation: 'horizontal',
        spacing: 'conjoined',
        buttons: [
            ['label' => 'One', 'type' => 'button', 'variant' => 'outline'],
            ['label' => 'Two', 'type' => 'button', 'variant' => 'outline'],
        ],
    );
}
```

### In a template file

```php
<?= new \Theme\Components\ButtonGroup(
    orientation: 'horizontal',
    spacing: 'conjoined',
    buttons: [
        ['label' => 'One', 'type' => 'button', 'variant' => 'outline'],
        ['label' => 'Two', 'type' => 'button', 'variant' => 'outline'],
    ],
) ?>
```

### Via global helpers

```php
the_component('button-group', [
    'orientation' => 'horizontal',
    'spacing'     => 'conjoined',
    'buttons'     => [
        ['label' => 'One', 'type' => 'button', 'variant' => 'outline'],
        ['label' => 'Two', 'type' => 'button', 'variant' => 'outline'],
    ],
]);

$html = get_component('button-group', [
    'orientation' => 'horizontal',
    'spacing'     => 'conjoined',
    'buttons'     => [
        ['label' => 'One', 'type' => 'button', 'variant' => 'outline'],
        ['label' => 'Two', 'type' => 'button', 'variant' => 'outline'],
    ],
]);
```

## ACF Fields

Fields are defined in `button_group_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All button-group fields as a single group |
| `orientation` | `FieldsBuilder` | Orientation select field |
| `orientation_choices` | `array` | Raw choices array for the orientation select |
| `spacing` | `FieldsBuilder` | Spacing select field |
| `spacing_choices` | `array` | Raw choices array for the spacing select |
| `size` | `FieldsBuilder` | Size select field |
| `buttons` | `FieldsBuilder` | Buttons repeater field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $button_group_fields = require get_stylesheet_directory() . '/components/button-group/button_group_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($button_group_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $button_group_fields = require get_stylesheet_directory() . '/components/button-group/button_group_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($button_group_fields['orientation'])
        ->addFields($button_group_fields['spacing']);
};
```
