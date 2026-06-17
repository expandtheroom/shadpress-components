# Empty State

Empty state display with title, description, and optional action link.

**shadcn/ui:** [empty-state](https://ui.shadcn.com/docs/components/radix/empty)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | `string` | `''` | Primary heading |
| `description` | `string` | `''` | Supporting text |
| `action_link` | `array` | `[]` | ACF link array for the call-to-action button (`url`, `title`, `target`) |
| `include_icon` | `bool\|int` | `0` | Whether to render an icon |
| `icon_provider` | `string` | `''` | Active icon provider key |
| `icon_lucide_icons` | `string` | `''` | Lucide icon name |
| `icon_image_icon` | `string` | `''` | Image icon value |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->empty ?>
    $this->empty = new \Theme\Components\EmptyState(
        title: 'No results found',
        description: 'Try adjusting your search or filters.',
        action_link: ['url' => '/search', 'title' => 'Clear filters'],
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\EmptyState(
        title: 'No results found',
        description: 'Try adjusting your search or filters.',
        action_link: ['url' => '/search', 'title' => 'Clear filters'],
    );
}
```

### In a template file

```php
<?= new \Theme\Components\EmptyState(
    title: 'No results found',
    description: 'Try adjusting your search or filters.',
    action_link: ['url' => '/search', 'title' => 'Clear filters'],
) ?>
```

### Via global helpers

```php
the_component('empty-state', [
    'title' => 'No results found',
    'description' => 'Try adjusting your search or filters.',
    'action_link' => ['url' => '/search', 'title' => 'Clear filters'],
]);

$html = get_component('empty-state', [
    'title' => 'No results found',
    'description' => 'Try adjusting your search or filters.',
    'action_link' => ['url' => '/search', 'title' => 'Clear filters'],
]);
```

## ACF Fields

Fields are defined in `empty_state_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All empty-state fields as a single group |
| `title` | `FieldsBuilder` | Title text field |
| `description` | `FieldsBuilder` | Description text field |
| `action_link` | `FieldsBuilder` | Action link field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $empty_state_fields = require get_stylesheet_directory() . '/components/empty-state/empty_state_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($empty_state_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $empty_state_fields = require get_stylesheet_directory() . '/components/empty-state/empty_state_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($empty_state_fields['title'])
        ->addFields($empty_state_fields['description']);
};
```
