# Calendar

Date picker calendar with min/max date constraints.

**shadcn/ui:** [Calendar](https://ui.shadcn.com/docs/components/calendar)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | `string` | `''` | HTML `name` attribute for the hidden date input |
| `selected_date` | `string` | `''` | Pre-selected date in `YYYY-MM-DD` format |
| `min_date` | `string` | `''` | Minimum selectable date in `YYYY-MM-DD` format |
| `max_date` | `string` | `''` | Maximum selectable date in `YYYY-MM-DD` format |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->calendar ?>
    $this->calendar = new \Theme\Components\Calendar(
        name: 'appointment_date',
        min_date: '2026-01-01',
        max_date: '2026-12-31',
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Calendar(
        name: 'appointment_date',
        min_date: '2026-01-01',
        max_date: '2026-12-31',
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Calendar(
    name: 'appointment_date',
    min_date: '2026-01-01',
    max_date: '2026-12-31',
) ?>
```

### Via global helpers

```php
the_component('calendar', [
    'name'     => 'appointment_date',
    'min_date' => '2026-01-01',
    'max_date' => '2026-12-31',
]);

$html = get_component('calendar', [
    'name'     => 'appointment_date',
    'min_date' => '2026-01-01',
    'max_date' => '2026-12-31',
]);
```

## ACF Fields

Fields are defined in `calendar_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All calendar fields as a single group |
| `name` | `FieldsBuilder` | Input name text field |
| `selected_date` | `FieldsBuilder` | Pre-selected date field |
| `min_date` | `FieldsBuilder` | Minimum date field |
| `max_date` | `FieldsBuilder` | Maximum date field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $calendar_fields = require get_stylesheet_directory() . '/components/calendar/calendar_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($calendar_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $calendar_fields = require get_stylesheet_directory() . '/components/calendar/calendar_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($calendar_fields['min_date'])
        ->addFields($calendar_fields['max_date']);
};
```
