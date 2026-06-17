# Breadcrumbs

Breadcrumb navigation with auto WordPress context or custom crumbs.

**shadcn/ui:** [Breadcrumb](https://ui.shadcn.com/docs/components/breadcrumb)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `source` | `string` | `'auto'` | `'auto'` — build from current WordPress hierarchy; `'custom'` — use the `crumbs` array |
| `crumbs` | `array` | `[]` | Array of crumb objects when `source` is `'custom'`. Each: `label` (string), `url` (string, optional) |
| `separator` | `string` | `'/'` | Separator character between crumbs |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->breadcrumbs ?>
    $this->breadcrumbs = new \Theme\Components\Breadcrumbs(
        source: 'custom',
        crumbs: [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Blog', 'url' => '/blog'],
            ['label' => 'Current Post'],
        ],
        separator: '/',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Breadcrumbs(
        source: 'custom',
        crumbs: [
            ['label' => 'Home', 'url' => '/'],
            ['label' => 'Blog', 'url' => '/blog'],
            ['label' => 'Current Post'],
        ],
        separator: '/',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Breadcrumbs(
    source: 'custom',
    crumbs: [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Blog', 'url' => '/blog'],
        ['label' => 'Current Post'],
    ],
    separator: '/',
) ?>
```

### Via global helpers

```php
the_component('breadcrumbs', [
    'source'    => 'custom',
    'crumbs'    => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Blog', 'url' => '/blog'],
        ['label' => 'Current Post'],
    ],
    'separator' => '/',
]);

$html = get_component('breadcrumbs', [
    'source'    => 'custom',
    'crumbs'    => [
        ['label' => 'Home', 'url' => '/'],
        ['label' => 'Blog', 'url' => '/blog'],
        ['label' => 'Current Post'],
    ],
    'separator' => '/',
]);
```

## ACF Fields

Fields are defined in `breadcrumbs_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All breadcrumbs fields as a single group |
| `source` | `FieldsBuilder` | Source select field (`auto` / `custom`) |
| `source_choices` | `array` | Raw choices array for the source select |
| `separator` | `FieldsBuilder` | Separator select field |
| `separator_choices` | `array` | Raw choices array for the separator select |
| `crumbs` | `FieldsBuilder` | Custom crumbs repeater field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $breadcrumbs_fields = require get_stylesheet_directory() . '/components/breadcrumbs/breadcrumbs_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($breadcrumbs_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $breadcrumbs_fields = require get_stylesheet_directory() . '/components/breadcrumbs/breadcrumbs_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($breadcrumbs_fields['source'])
        ->addFields($breadcrumbs_fields['crumbs']);
};
```
