# Card

Card layout with optional badge, content, and action button.

**shadcn/ui:** [Card](https://ui.shadcn.com/docs/components/card)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | `string` | `''` | Card heading |
| `description` | `string` | `''` | Card subtitle or short description |
| `image` | `array` | `[]` | ACF image array (`url`, `alt`, `width`, `height`) |
| `card_content` | `string` | `''` | HTML body content |
| `link` | `array` | `[]` | ACF link array for the action button (`url`, `title`, `target`) |
| `badge` | `string` | `''` | Badge label text displayed on the card |
| `include_icon` | `bool\|int` | `0` | Whether to render an icon |
| `icon_provider` | `string` | `''` | Active icon provider key |
| `icon_lucide_icons` | `string` | `''` | Lucide icon name |
| `icon_image_icon` | `string` | `''` | Image icon value |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->card ?>
    $this->card = new \Theme\Components\Card(
        title: 'Getting started',
        description: 'Learn the basics in five minutes.',
        link: ['url' => '/docs', 'title' => 'Read more'],
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Card(
        title: 'Getting started',
        description: 'Learn the basics in five minutes.',
        link: ['url' => '/docs', 'title' => 'Read more'],
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Card(
    title: 'Getting started',
    description: 'Learn the basics in five minutes.',
    link: ['url' => '/docs', 'title' => 'Read more'],
) ?>
```

### Via global helpers

```php
the_component('card', [
    'title'       => 'Getting started',
    'description' => 'Learn the basics in five minutes.',
    'link'        => ['url' => '/docs', 'title' => 'Read more'],
]);

$html = get_component('card', [
    'title'       => 'Getting started',
    'description' => 'Learn the basics in five minutes.',
    'link'        => ['url' => '/docs', 'title' => 'Read more'],
]);
```

## ACF Fields

Fields are defined in `card_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All card fields as a single group |
| `title` | `FieldsBuilder` | Title text field |
| `description` | `FieldsBuilder` | Description text field |
| `image` | `FieldsBuilder` | Image field |
| `content` | `FieldsBuilder` | Body content WYSIWYG field |
| `link` | `FieldsBuilder` | Action link field |
| `badge` | `FieldsBuilder` | Badge label text field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $card_fields = require get_stylesheet_directory() . '/components/card/card_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($card_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $card_fields = require get_stylesheet_directory() . '/components/card/card_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($card_fields['title'])
        ->addFields($card_fields['link']);
};
```
