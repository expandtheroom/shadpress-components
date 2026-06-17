# Carousel

Image carousel with loop, autoplay, and configurable transitions.

**shadcn/ui:** [Carousel](https://ui.shadcn.com/docs/components/carousel)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `slides` | `array` | `[]` | Array of slide objects. Each: `image` (ACF image array) |
| `loop` | `bool` | `false` | Whether to loop infinitely |
| `autoplay` | `bool` | `false` | Whether to advance slides automatically |
| `autoplay_delay` | `int` | `3000` | Autoplay interval in milliseconds |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->carousel ?>
    $this->carousel = new \Theme\Components\Carousel(
        slides: [
            ['image' => ['url' => '/img/slide1.jpg', 'alt' => 'Slide one']],
            ['image' => ['url' => '/img/slide2.jpg', 'alt' => 'Slide two']],
        ],
        loop: true,
        autoplay: true,
        autoplay_delay: 4000,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Carousel(
        slides: [
            ['image' => ['url' => '/img/slide1.jpg', 'alt' => 'Slide one']],
            ['image' => ['url' => '/img/slide2.jpg', 'alt' => 'Slide two']],
        ],
        loop: true,
        autoplay: true,
        autoplay_delay: 4000,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Carousel(
    slides: [
        ['image' => ['url' => '/img/slide1.jpg', 'alt' => 'Slide one']],
        ['image' => ['url' => '/img/slide2.jpg', 'alt' => 'Slide two']],
    ],
    loop: true,
    autoplay: true,
    autoplay_delay: 4000,
) ?>
```

### Via global helpers

```php
the_component('carousel', [
    'slides' => [
        ['image' => ['url' => '/img/slide1.jpg', 'alt' => 'Slide one']],
        ['image' => ['url' => '/img/slide2.jpg', 'alt' => 'Slide two']],
    ],
    'loop'           => true,
    'autoplay'       => true,
    'autoplay_delay' => 4000,
]);

$html = get_component('carousel', [
    'slides' => [
        ['image' => ['url' => '/img/slide1.jpg', 'alt' => 'Slide one']],
        ['image' => ['url' => '/img/slide2.jpg', 'alt' => 'Slide two']],
    ],
    'loop'           => true,
    'autoplay'       => true,
    'autoplay_delay' => 4000,
]);
```

## ACF Fields

Fields are defined in `carousel_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All carousel fields as a single group |
| `slides` | `FieldsBuilder` | Slides repeater field |
| `options` | `FieldsBuilder` | Loop / autoplay / delay options fields |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $carousel_fields = require get_stylesheet_directory() . '/components/carousel/carousel_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($carousel_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $carousel_fields = require get_stylesheet_directory() . '/components/carousel/carousel_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($carousel_fields['slides'])
        ->addFields($carousel_fields['options']);
};
```
