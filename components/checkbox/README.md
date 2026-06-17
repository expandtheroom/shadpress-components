# Checkbox

Standalone checkbox input with label and validation states.

> **Note:** This is a raw control — it renders only the HTML element with no label, description, or error state. For a complete form field use [`CheckboxField`](../checkbox-field/README.md). For ACF block use, see [`FormField`](../form-field/README.md).

**shadcn/ui:** [Checkbox](https://ui.shadcn.com/docs/components/checkbox)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `checked` | `bool` | `false` | Initial checked state |
| `disabled` | `bool` | `false` | Disables the checkbox |
| `label` | `string` | `''` | Visible label text |
| `name` | `string` | `''` | HTML `name` attribute |
| `required` | `bool` | `false` | Marks the field as required |
| `value` | `string` | `'1'` | Value submitted when checked |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->checkbox ?>
    $this->checkbox = new \Theme\Components\Checkbox(
        name: 'agree',
        label: 'I agree to the terms',
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Checkbox(
        name: 'agree',
        label: 'I agree to the terms',
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Checkbox(
    name: 'agree',
    label: 'I agree to the terms',
    required: true,
) ?>
```

### Via global helpers

```php
the_component('checkbox', [
    'name'     => 'agree',
    'label'    => 'I agree to the terms',
    'required' => true,
]);

$html = get_component('checkbox', [
    'name'     => 'agree',
    'label'    => 'I agree to the terms',
    'required' => true,
]);
```
