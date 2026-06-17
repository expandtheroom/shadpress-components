# Select

Native HTML select dropdown.

> **Note:** This is a raw control — it renders only the HTML element with no label, description, or error state. For a complete form field use [`SelectField`](../select-field/README.md). For ACF block use, see [`FormField`](../form-field/README.md).

**shadcn/ui:** [Select](https://ui.shadcn.com/docs/components/native-select)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `name` | `string` | `''` | HTML `name` attribute |
| `id` | `string` | `''` | HTML `id` attribute |
| `placeholder` | `string` | `''` | Placeholder option text (rendered as a disabled first option) |
| `options` | `array` | `[]` | Array of option objects. Each: `label` (string), `value` (string) |
| `required` | `bool` | `false` | Marks the field as required |
| `disabled` | `bool` | `false` | Disables the select |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->select ?>
    $this->select = new \Theme\Components\Select(
        name: 'country',
        id: 'country-select',
        placeholder: 'Select a country',
        options: [
            ['label' => 'Croatia', 'value' => 'hr'],
            ['label' => 'Germany', 'value' => 'de'],
        ],
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Select(
        name: 'country',
        id: 'country-select',
        placeholder: 'Select a country',
        options: [
            ['label' => 'Croatia', 'value' => 'hr'],
            ['label' => 'Germany', 'value' => 'de'],
        ],
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Select(
    name: 'country',
    id: 'country-select',
    placeholder: 'Select a country',
    options: [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    required: true,
) ?>
```

### Via global helpers

```php
the_component('select', [
    'name'        => 'country',
    'id'          => 'country-select',
    'placeholder' => 'Select a country',
    'options'     => [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    'required'    => true,
]);

$html = get_component('select', [
    'name'        => 'country',
    'id'          => 'country-select',
    'placeholder' => 'Select a country',
    'options'     => [
        ['label' => 'Croatia', 'value' => 'hr'],
        ['label' => 'Germany', 'value' => 'de'],
    ],
    'required'    => true,
]);
```
