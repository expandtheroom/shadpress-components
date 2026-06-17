# Date Picker Field

Native HTML date picker with label and placeholder support.

**shadcn/ui:** [date-picker](https://ui.shadcn.com/docs/components/date-picker)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `''` | Field label text |
| `placeholder` | `string` | `'Pick a date'` | Placeholder text |
| `selected_date` | `string` | `''` | Pre-selected date in `YYYY-MM-DD` format |
| `min_date` | `string` | `''` | Minimum selectable date in `YYYY-MM-DD` format |
| `max_date` | `string` | `''` | Maximum selectable date in `YYYY-MM-DD` format |
| `description` | `string` | `''` | Helper text shown below the field |
| `required` | `bool` | `false` | Marks the field as required |
| `error` | `string` | `''` | Error message; leave blank for no error state |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->date_field ?>
    $this->date_field = new \Theme\Components\DatePickerField(
        label: 'Appointment date',
        placeholder: 'Select a date',
        min_date: '2026-01-01',
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\DatePickerField(
        label: 'Appointment date',
        placeholder: 'Select a date',
        min_date: '2026-01-01',
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\DatePickerField(
    label: 'Appointment date',
    placeholder: 'Select a date',
    min_date: '2026-01-01',
    required: true,
) ?>
```

### Via global helpers

```php
the_component('date-picker-field', [
    'label' => 'Appointment date',
    'placeholder' => 'Select a date',
    'min_date' => '2026-01-01',
    'required' => true,
]);

$html = get_component('date-picker-field', [
    'label' => 'Appointment date',
    'placeholder' => 'Select a date',
    'min_date' => '2026-01-01',
    'required' => true,
]);
```

## ACF Fields

Fields are defined in `date_picker_fields.php`.

### Available keys

| Key | Type | Description |
|-----|------|-------------|
| `full` | `FieldsBuilder` | All date-picker-field fields as a single group |
| `label` | `FieldsBuilder` | Label text field |
| `description` | `FieldsBuilder` | Helper description text field |
| `required` | `FieldsBuilder` | Required true/false field |
| `error` | `FieldsBuilder` | Error message text field |
| `placeholder` | `FieldsBuilder` | Placeholder text field |
| `selected_date` | `FieldsBuilder` | Pre-selected date field |
| `min_date` | `FieldsBuilder` | Minimum date field |
| `max_date` | `FieldsBuilder` | Maximum date field |

### Import full fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $date_picker_field_fields = require get_stylesheet_directory() . '/components/date-picker-field/date_picker_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($date_picker_field_fields['full']);
};
```

### Import partial fields

```php
<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

return function (FieldsBuilder $fields) {
    $date_picker_field_fields = require get_stylesheet_directory() . '/components/date-picker-field/date_picker_fields.php';

    $fields
        ->addText('my_field', ['label' => 'My Field'])
        ->addFields($date_picker_field_fields['label'])
        ->addFields($date_picker_field_fields['required']);
};
```
