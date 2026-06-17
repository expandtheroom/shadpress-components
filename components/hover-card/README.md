# HoverCard

Inline hover card with dynamic positioning and content.

**shadcn/ui:** [hover-card](https://ui.shadcn.com/docs/components/hover-card)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `trigger_label` | `string` | `''` | Visible trigger link text |
| `trigger_url` | `string` | `''` | URL the trigger link points to |
| `card_content` | `string` | `''` | HTML content inside the hover card |
| `side` | `string` | `'bottom'` | Card position: `'top'`, `'right'`, `'bottom'`, `'left'` |
| `align` | `string` | `'center'` | Card alignment: `'start'`, `'center'`, `'end'` |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->x ?>
    $this->hover_card = new \Theme\Components\HoverCard(
        trigger_label: '@infinum',
        trigger_url: 'https://infinum.com',
        card_content: '<p>Infinum is a design and development agency.</p>',
        side: 'bottom',
        align: 'start',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\HoverCard(
        trigger_label: '@infinum',
        trigger_url: 'https://infinum.com',
        card_content: '<p>Infinum is a design and development agency.</p>',
        side: 'bottom',
        align: 'start',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\HoverCard(
    trigger_label: '@infinum',
    trigger_url: 'https://infinum.com',
    card_content: '<p>Infinum is a design and development agency.</p>',
    side: 'bottom',
    align: 'start',
) ?>
```

### Via global helpers

```php
the_component('hover-card', [
    'trigger_label' => '@infinum',
    'trigger_url' => 'https://infinum.com',
    'card_content' => '<p>Infinum is a design and development agency.</p>',
    'side' => 'bottom',
    'align' => 'start',
]);

$html = get_component('hover-card', [
    'trigger_label' => '@infinum',
    'trigger_url' => 'https://infinum.com',
    'card_content' => '<p>Infinum is a design and development agency.</p>',
    'side' => 'bottom',
    'align' => 'start',
]);
```

## ACF Fields

Fields are defined in `hover_card_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All hover-card fields as a single group |
| `trigger_label` | `FieldsBuilder` | Trigger link text field |
| `trigger_url` | `FieldsBuilder` | Trigger URL text field |
| `card_content` | `FieldsBuilder` | Card content WYSIWYG field |
| `side` | `FieldsBuilder` | Side select field |
| `side_choices` | `array` | Raw choices array for the side select |
| `align` | `FieldsBuilder` | Alignment select field |
| `align_choices` | `array` | Raw choices array for the alignment select |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $hover_card_fields = require get_stylesheet_directory() . '/components/hover-card/hover_card_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($hover_card_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $hover_card_fields = require get_stylesheet_directory() . '/components/hover-card/hover_card_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($hover_card_fields['trigger_label'])
        ->addFields($hover_card_fields['card_content']);
};
```
