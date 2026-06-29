# Shadpress Components

Prebuilt UI components for WordPress themes built on the ETR WordPress Starter. They are PHP/ACF/Alpine.js ports of [shadcn/ui](https://ui.shadcn.com/docs/components) — same visual language and API shape, adapted to the starter theme's component system.

---

## Overview

Each component lives in `components/{slug}/` and follows the starter theme's file conventions:

| File | Role |
|------|------|
| `{ClassName}.php` | Typed PHP ViewModel (extends `BaseComponent`) |
| `template.php` | HTML view; `$this` is the component instance |
| `block.json` | Registers the component as an ACF Gutenberg block |
| `fields.php` | ACF field definitions for the block |
| `{slug}_fields.php` | Exportable field schema — import into parent blocks |
| `alpine.js` | Alpine.js data module; lazy-loaded; camelCase slug = `x-data` name |
| `component.css` | Styles; eagerly bundled into the main stylesheet |

See [README_Components.md](README_Components.md) for the full architecture reference: base class API, data flow, block registration, template context, and CSS/Alpine patterns.

---

## Installation

### Via the generator (recommended)

From the starter theme root, run:

```bash
make generate
```

Select **shadpress**, then pick one or more components from the multi-select list. The generator copies the selected components into your theme's `components/` directory and handles the following automatically:

- **Dependency resolution** — if `accordion` requires `typography`, both are installed.
- **Skip already-installed** — existing components are not overwritten; safe to re-run.
- **Icon provider prompt** — components that accept icons will ask whether to install `lucide-icons` or `image-icon` if no provider is present yet.

**Via Claude Code:** type `/benchpress` and select **Install a ShadPress component** to run the same generator from conversation.

### Manual copy

Copy any component directory directly into your theme's `components/` folder:

```bash
cp -r path/to/shadpress-components/components/button themes/my-theme/components/
```

Check each component's `README.md` for its dependencies and install those too.

The starter theme's `BlockRegistry` auto-discovers `block.json` files, so no manual registration is needed after copying.

---

## Usage

### Direct instantiation (recommended)

```php
echo new \Theme\Components\Button(
    variant: 'default',
    link: ['url' => '/contact', 'title' => 'Contact us'],
);

$html = new \Theme\Components\Card(title: 'Hello', body: 'World');
```

### Slug-based helpers

```php
the_component('button', ['variant' => 'outline', 'label' => 'Submit', 'type' => 'submit']);

$html = get_component('card', ['title' => 'Hello', 'body' => 'World']);
```

### Importing ACF fields into a parent block

```php
return function (FieldsBuilder $fields) {
    $button_fields = require get_stylesheet_directory() . '/components/button/button_fields.php';

    $fields
        ->addText('heading')
        ->addFields($button_fields['full']); // or a partial key like $button_fields['variant']
};
```

Each component's `README.md` lists its available field keys and props.

---

## Components

### Layout & Content

| Component | Description | shadcn/ui |
|-----------|-------------|-----------|
| [accordion](components/accordion) | Expandable accordion panels | [Accordion](https://ui.shadcn.com/docs/components/accordion) |
| [card](components/card) | Card layout with badge, content, and action button | [Card](https://ui.shadcn.com/docs/components/card) |
| [carousel](components/carousel) | Image carousel with loop, autoplay, and transitions | [Carousel](https://ui.shadcn.com/docs/components/carousel) |
| [collapsible](components/collapsible) | Collapsible content panel with trigger | [Collapsible](https://ui.shadcn.com/docs/components/collapsible) |
| [scroll-area](components/scroll-area) | Scrollable container with max-height control | [Scroll Area](https://ui.shadcn.com/docs/components/scroll-area) |
| [separator](components/separator) | Visual divider line (horizontal / vertical) | [Separator](https://ui.shadcn.com/docs/components/separator) |
| [tabs](components/tabs) | Tab panels with typography content | [Tabs](https://ui.shadcn.com/docs/components/tabs) |
| [typography](components/typography) | Rich text renderer with variant styling | [Typography](https://ui.shadcn.com/docs/components/typography) |

### Navigation

| Component | Description | shadcn/ui |
|-----------|-------------|-----------|
| [breadcrumbs](components/breadcrumbs) | Breadcrumb nav; auto WordPress context or custom crumbs | [Breadcrumb](https://ui.shadcn.com/docs/components/breadcrumb) |
| [menubar](components/menubar) | Top-level navigation menu bar with hierarchical items | [Menubar](https://ui.shadcn.com/docs/components/menubar) |
| [pagination](components/pagination) | WordPress pagination with previous/next links | [Pagination](https://ui.shadcn.com/docs/components/pagination) |

### Overlays & Feedback

| Component | Description | shadcn/ui |
|-----------|-------------|-----------|
| [alert](components/alert) | Alert banner with optional dismissible variant | [Alert](https://ui.shadcn.com/docs/components/alert) |
| [alert-dialog](components/alert-dialog) | Modal dialog for confirming destructive actions | [Alert Dialog](https://ui.shadcn.com/docs/components/alert-dialog) |
| [dialog](components/dialog) | General-purpose modal dialog | [Dialog](https://ui.shadcn.com/docs/components/dialog) |
| [dropdown-menu](components/dropdown-menu) | Dropdown menu with items, labels, and separators | [Dropdown Menu](https://ui.shadcn.com/docs/components/dropdown-menu) |
| [empty-state](components/empty-state) | Empty state display with title, description, and action | [Empty State](https://ui.shadcn.com/docs/components/radix/empty) |
| [hover-card](components/hover-card) | Inline hover card with dynamic positioning | [Hover Card](https://ui.shadcn.com/docs/components/hover-card) |
| [popover](components/popover) | Floating popover with positioning and alignment options | [Popover](https://ui.shadcn.com/docs/components/popover) |
| [tooltip](components/tooltip) | Floating tooltip with configurable side and alignment | [Tooltip](https://ui.shadcn.com/docs/components/tooltip) |

### Actions

| Component | Description | shadcn/ui |
|-----------|-------------|-----------|
| [badge](components/badge) | Inline badge with styling variants | [Badge](https://ui.shadcn.com/docs/components/badge) |
| [button](components/button) | Versatile button with variants, sizes, and icon support | [Button](https://ui.shadcn.com/docs/components/button) |
| [button-group](components/button-group) | Group of buttons with orientation, spacing, and alignment | — |
| [toggle](components/toggle) | Toggle button built on `Button` | [Toggle](https://ui.shadcn.com/docs/components/toggle) |
| [toggle-group](components/toggle-group) | Multi-select toggle group; drop-in for checkbox group | [Toggle Group](https://ui.shadcn.com/docs/components/toggle-group) |

### Form — Raw Controls

These render only the HTML element. Use the wrapped field variants below for label, description, and error states.

| Component | Description | shadcn/ui |
|-----------|-------------|-----------|
| [checkbox](components/checkbox) | Standalone checkbox with validation states | [Checkbox](https://ui.shadcn.com/docs/components/checkbox) |
| [input](components/input) | Text input with type variants and validation | [Input](https://ui.shadcn.com/docs/components/input) |
| [label](components/label) | Form label with optional required indicator | [Label](https://ui.shadcn.com/docs/components/label) |
| [select](components/select) | Native HTML select dropdown | [Native Select](https://ui.shadcn.com/docs/components/native-select) |
| [textarea](components/textarea) | Multi-line text input with configurable rows | [Textarea](https://ui.shadcn.com/docs/components/textarea) |

### Form — Wrapped Fields

Full form fields with label, description, and error handling wired up.

| Component | Description | shadcn/ui |
|-----------|-------------|-----------|
| [checkbox-field](components/checkbox-field) | Checkbox wrapped as a complete form field | [Checkbox](https://ui.shadcn.com/docs/components/checkbox) |
| [checkbox-group-field](components/checkbox-group-field) | Group of checkboxes submitting as an array | [Checkbox](https://ui.shadcn.com/docs/components/checkbox) |
| [combobox-field](components/combobox-field) | Searchable dropdown combobox | [Combobox](https://ui.shadcn.com/docs/components/combobox) |
| [date-picker-field](components/date-picker-field) | Native date picker with label and placeholder | [Date Picker](https://ui.shadcn.com/docs/components/date-picker) |
| [form-field](components/form-field) | Unified Gutenberg block wrapper for multiple control types | — |
| [input-field](components/input-field) | Input wrapped as a complete form field | [Input](https://ui.shadcn.com/docs/components/input) |
| [radio-group-field](components/radio-group-field) | Radio button group with orientation control | [Radio Group](https://ui.shadcn.com/docs/components/radio-group) |
| [select-field](components/select-field) | Native select wrapped as a complete form field | [Native Select](https://ui.shadcn.com/docs/components/native-select) |
| [styled-select-field](components/styled-select-field) | Custom styled select with label and error handling | [Select](https://ui.shadcn.com/docs/components/select) |
| [switch-toggle](components/switch-toggle) | Toggle switch for boolean form input | [Switch](https://ui.shadcn.com/docs/components/switch) |
| [textarea-field](components/textarea-field) | Textarea wrapped as a complete form field | [Textarea](https://ui.shadcn.com/docs/components/textarea) |

### Dates

| Component | Description | shadcn/ui |
|-----------|-------------|-----------|
| [calendar](components/calendar) | Date picker calendar with min/max constraints | [Calendar](https://ui.shadcn.com/docs/components/calendar) |

### Icons

| Component | Description |
|-----------|-------------|
| [lucide-icons](components/lucide-icons) | Renders SVG icons by name from [lucide.dev](https://lucide.dev/icons) |
| [image-icon](components/image-icon) | Icon provider for image-based icons |

### CSS-only Utilities

These have no PHP class or template — they exist only to inject Tailwind utilities.

| Component | Description |
|-----------|-------------|
| [rich-text-utils](components/rich-text-utils) | `rich-text-*` utilities + `.rich-text` container class for styled HTML content |
| [wp-styles](components/wp-styles) | Styles Gutenberg `wp-block-*` output on the front end using `rich-text-*` utilities |

---

## Design Tokens

Components rely on the semantic design tokens defined in the starter theme's `assets/src/css/theme.css` (e.g. `bg-muted`, `text-primary`, `border-border`). Install the starter theme's CSS before using these components.

---

## Related

- [ETR WordPress Starter](https://github.com/expandtheroom/etr-wordpress-starter) — the theme framework these components target
- [shadcn/ui](https://ui.shadcn.com/docs/components) — the React component library these are based on
- [Lucide Icons](https://lucide.dev/icons) — icon library used by `lucide-icons`
