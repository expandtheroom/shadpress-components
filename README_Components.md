# ETR WordPress Starter — Component System Summary

## Overview

Components are self-contained directories under `themes/{theme_name}/components/{slug}/`. They can serve as reusable UI partials, ACF Gutenberg blocks, or both. Every file is optional — use only what the component needs.

---

## Component Files

| File | Purpose |
|---|---|
| `template.php` | HTML view; rendered as a PHP include with `$this` bound to the component instance |
| `block.json` | Registers the component as an ACF Gutenberg block (auto-discovered) |
| `fields.php` | ACF field definitions (returns a callable receiving a `FieldsBuilder`) |
| `{slug}_fields.php` | Exportable field schema for non-block components; parent blocks include this to embed fields |
| `{ClassName}.php` | Optional typed ViewModel class extending `BaseComponent` |
| `alpine.js` | Auto-discovered Alpine data component; lazy-loaded; slug → camelCase is the `x-data` name |
| `component.js` | Vite entry point; lazy-loaded via `IntersectionObserver` when `[data-component="slug"]` enters viewport |
| `component.css` | Eagerly bundled into the main stylesheet; supports `@reference "@src/css/index.css"` for Tailwind/token utilities |

---

## PHP Class Architecture

**`BaseComponent`** (abstract base) — all components extend this. Provides:

- `$this->block`, `$this->content`, `$this->is_preview`, `$this->post_id` — injected by `set_context()` before render
- `prepare()` — lifecycle hook called before template inclusion; override for WP queries or anything needing block context
- `render()` — calls `prepare()`, then buffers and returns the template
- `__toString()` — delegates to `render()` so components can be directly echoed
- `component_slug()` — returns the directory name (e.g. `my-card`)
- `component_module_name()` — camelCase version (e.g. `myCard`); matches the Alpine `x-data` name
- `component_attrs()` — builds the root element attribute string: `data-component`, custom attrs from `set_attrs()`, and the block anchor
- `component_classes()` — returns the CSS class string: slug + block toolbar classes; override to add more
- `get_block_classes()` — WordPress `className` + `align-{value}` from the block toolbar
- `get_alignment_class()` — `align-{value}`, or `''`
- `get_anchor_attr()` — `id="..."` string, or `''`
- `compile_attrs(array)` — escapes and serializes a key/value array to an HTML attribute string
- `set_attrs()` — override to add component-specific HTML attributes; spread `$this->extra_attrs` at the end to allow caller overrides
- Static hooks (auto-wired by `BlockRegistry`):
  - `register()` — called once at init for one-time WP hook registration
  - `enqueue_editor_assets()` — hooked to `enqueue_block_editor_assets` automatically when present

**`DefaultComponent`** — used when no `{ClassName}.php` exists. Exposes all ACF fields as dynamic properties via `__get`, so `$this->field_name` works in templates without any class definition.

---

## Constructor & Data Flow

When a block renders, `ComponentFactory::make_component()`:

1. Derives the class name from the slug (`my-card` → `MyCard`)
2. If a `from_acf(array $fields): self` static factory exists, delegates to it
3. Otherwise, maps ACF field values to constructor parameters **by name** (parameter name must match the ACF field key exactly)
4. Falls back to `DefaultComponent` if no class file exists

After instantiation, `set_context($block, $content, $is_preview, $post_id)` is called to inject block metadata. Then `render()` calls `prepare()` and includes the template.

**Rule of thumb:**
- `__construct()` — pure normalization of passed values; no WP queries, no globals
- `prepare()` — WP queries, child component instantiation, anything needing `$this->block` / `$this->is_preview` / `$this->post_id`

---

## Block Registration (auto-discovery)

`BlockRegistry::init()` recursively scans `components/` for `block.json` files. For each one found:

- If the JSON has an `acf` key, registers the block via `register_block_type()` with a `render_callback` that invokes `ComponentFactory`
- Registers ACF fields from `fields.php` scoped to the block
- Requires the component's `{ClassName}.php` (if present) and calls `register()` / wires `enqueue_editor_assets()`

---

## Rendering Components

**Direct instantiation** (recommended when class is known):

```php
echo new MyCard(title: 'Hello', body: 'World');
$html = (new MyCard(title: 'Hello'))->render();
```

**Slug-based helpers** (useful with dynamic data arrays):

```php
the_component('my-card', ['title' => 'Hello', 'body' => 'World']);
$html = get_component('my-card', ['title' => 'Hello']);
```

Both paths ultimately call `ComponentFactory::render_component()`.

---

## Template Context (`$this` inside `template.php`)

| Property/Method | Type | Notes |
|---|---|---|
| `$this->block` | `array` | ACF block data (anchor, className, align, id, …) |
| `$this->content` | `string` | Inner block HTML (InnerBlocks) |
| `$this->is_preview` | `bool` | `true` inside the block editor |
| `$this->post_id` | `int` | Post being rendered |
| `$this->component_attrs()` | `string` | Root element attribute string (data-component + custom + anchor) |
| `$this->component_classes()` | `string` | Root element CSS classes (slug + toolbar classes) |
| `$this->get_anchor_attr()` | `string` | `id="..."` or `''` |
| `$this->get_block_classes()` | `string` | WP className + align class |
| `$this->{field_name}` | mixed | Any ACF field or constructor property |

Reserved field names that throw at render time: `block`, `content`, `post_id`. `is_preview` is special — it ORs with the block callback value rather than throwing.

---

## Alpine.js Pattern

`alpine.js` files export a default factory function. The slug is camelCased and used as the `x-data` attribute value. Alpine modules are lazy-loaded: only fetched when a matching `x-data` element is found on the page. The MutationObserver also handles htmx-injected content.

Named components (via `alpine.js`) are strongly preferred over inline `x-data` objects inside ACF blocks, because:

1. ACF's block editor JS attempts `JSON.parse` on any `x-data` value starting with `{`, breaking previews
2. The editor's CSP blocks `new Function()` evaluation, so inline Alpine expressions don't execute in the editor

---

## CSS Pattern

`component.css` should begin with:

```css
@reference "@src/css/index.css";
```

This gives `@apply` access to Tailwind utilities and the project's semantic design tokens (`bg-muted`, `text-primary`, `border-border`, etc.) defined in `assets/src/css/theme.css`.

Always use the `classNames()` PHP helper to compose CSS class strings in templates — never string concatenation.

---

## Shadpress Components

Shadpress components are installed into `components/` via the generator (the same directory as custom components). Once installed they are editable freely. They use the same `BaseComponent` base class, the same file conventions, and the same template context as all other components. They depend on the semantic design tokens from `theme.css` for their default styles.
