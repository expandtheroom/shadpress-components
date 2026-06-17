# Accordion

Expandable accordion panels with typography content.

**shadcn/ui:** [Accordion](https://ui.shadcn.com/docs/components/accordion)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `panels` | `array` | `[]` | Array of panel objects. Each: `trigger` (string, heading text), `content` (string, HTML body) |
| `type` | `string` | `'single'` | `'single'` — one panel open at a time; `'multiple'` — any number open |
| `include_icon` | `bool\|int` | `0` | Whether to render an icon in each panel trigger |
| `icon_provider` | `string` | `''` | Active icon provider key (falls back to first registered) |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->accordion ?>
    $this->accordion = new \Theme\Components\Accordion(
        panels: [
            ['trigger' => 'What is this?', 'content' => '<p>It is an accordion.</p>'],
            ['trigger' => 'How does it work?', 'content' => '<p>Click a trigger to expand.</p>'],
        ],
        type: 'single',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Accordion(
        panels: [
            ['trigger' => 'What is this?', 'content' => '<p>It is an accordion.</p>'],
            ['trigger' => 'How does it work?', 'content' => '<p>Click a trigger to expand.</p>'],
        ],
        type: 'single',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Accordion(
    panels: [
        ['trigger' => 'What is this?', 'content' => '<p>It is an accordion.</p>'],
        ['trigger' => 'How does it work?', 'content' => '<p>Click a trigger to expand.</p>'],
    ],
    type: 'single',
) ?>
```

### Via global helpers

```php
the_component('accordion', [
    'panels' => [
        ['trigger' => 'What is this?', 'content' => '<p>It is an accordion.</p>'],
    ],
    'type' => 'single',
]);

$html = get_component('accordion', [
    'panels' => [
        ['trigger' => 'What is this?', 'content' => '<p>It is an accordion.</p>'],
    ],
    'type' => 'single',
]);
```

## ACF Fields

Fields are defined in `accordion_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All accordion fields as a single group |
| `type` | `FieldsBuilder` | Accordion type select (`single` / `multiple`) |
| `type_choices` | `array` | Raw choices array for the type select |
| `panels` | `FieldsBuilder` | Panels repeater (trigger + content per panel) |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $accordion_fields = require get_stylesheet_directory() . '/components/accordion/accordion_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($accordion_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $accordion_fields = require get_stylesheet_directory() . '/components/accordion/accordion_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($accordion_fields['type'])
        ->addFields($accordion_fields['panels']);
};
```
