# Input

Text input field with type variants and validation support.

> **Note:** This is a raw control — it renders only the HTML element with no label, description, or error state. For a complete form field use [`InputField`](../input-field/README.md). For ACF block use, see [`FormField`](../form-field/README.md).

**shadcn/ui:** [Input](https://ui.shadcn.com/docs/components/input)

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `type` | `string` | `'text'` | HTML input type: `'text'`, `'email'`, `'password'`, `'number'`, `'tel'`, `'url'`, `'search'` |
| `name` | `string` | `''` | HTML `name` attribute |
| `id` | `string` | `''` | HTML `id` attribute |
| `placeholder` | `string` | `''` | Placeholder text |
| `default_value` | `string` | `''` | Pre-filled value |
| `required` | `bool` | `false` | Marks the field as required |
| `disabled` | `bool` | `false` | Disables the input |
| `readonly` | `bool` | `false` | Makes the input read-only |
| `extra_attrs` | `array` | `[]` | Extra HTML attributes merged onto the root element |

## Usage

### In a component class

```php
public function prepare(): void {
    // Assign to property — echoed in template as <?= $this->input ?>
    $this->input = new \Theme\Components\Input(
        type: 'email',
        name: 'user_email',
        id: 'user-email',
        placeholder: 'you@example.com',
        required: true,
    );

    // Or capture as a string immediately
    $html = (string) new \Theme\Components\Input(
        type: 'email',
        name: 'user_email',
        id: 'user-email',
        placeholder: 'you@example.com',
        required: true,
    );
}
```

### In a template file

```php
<?= new \Theme\Components\Input(
    type: 'email',
    name: 'user_email',
    id: 'user-email',
    placeholder: 'you@example.com',
    required: true,
) ?>
```

### Via global helpers

```php
the_component('input', [
    'type'        => 'email',
    'name'        => 'user_email',
    'id'          => 'user-email',
    'placeholder' => 'you@example.com',
    'required'    => true,
]);

$html = get_component('input', [
    'type'        => 'email',
    'name'        => 'user_email',
    'id'          => 'user-email',
    'placeholder' => 'you@example.com',
    'required'    => true,
]);
```
