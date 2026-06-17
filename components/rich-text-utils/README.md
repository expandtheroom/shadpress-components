# Rich Text Utils

CSS-only component. No PHP class, no template. Defines a suite of `rich-text-*` Tailwind utilities for common HTML text elements, and a `.rich-text` container class that applies them all to descendant elements.

## Utilities

| Utility | Element | Notes |
| --- | --- | --- |
| `rich-text-h1` | `h1` | |
| `rich-text-h2` | `h2` | |
| `rich-text-h3` | `h3` | |
| `rich-text-h4` | `h4` | |
| `rich-text-h5` | `h5` | |
| `rich-text-h6` | `h6` | |
| `rich-text-p` | `p` | |
| `rich-text-blockquote` | `blockquote` | |
| `rich-text-ul` | `ul` | |
| `rich-text-ol` | `ol` | |
| `rich-text-li` | `li` | |
| `rich-text-hr` | `hr` | |
| `rich-text-pre` | `pre` | Code block wrapper |
| `rich-text-code` | `code` | Inline only — not applied to `pre > code` |
| `rich-text-a` | `a` | |
| `rich-text-figure` | `figure` | |
| `rich-text-figcaption` | `figcaption` | |
| `rich-text-img` | `img` | |
| `rich-text-table` | `table` | |
| `rich-text-th` | `th` | |
| `rich-text-td` | `td` | |

All utilities use semantic token classes (`border-border`, `bg-muted`, `text-primary`, etc.) — no hardcoded colours.

## `.rich-text` container class

Applies every utility above to matching descendant elements. Use it on any wrapper element whose HTML content should render with these styles.

```html
<div class="rich-text">
  <!-- h1–h6, p, ul, ol, blockquote, img, etc. styled automatically -->
</div>
```

Links inside `.rich-text` use `a:not([class])` so that anchors with explicit classes (buttons, branded links) are excluded.

## Usage in other component CSS

Apply individual utilities with `@apply` to target specific selectors:

```css
h2.wp-block-heading { @apply rich-text-h2; }
```

Components that use these utilities should declare `rich-text-utils` in their `index.json` `requires` array.

## Non-standard installation

This component deviates from the standard component pattern. Normally, component styles live in `component.css` and are bundled automatically by Vite's glob import:

```js
import.meta.glob('../../components/*/component.css', { eager: true })
```

`rich-text-utils` instead uses `rich-text-utils.css` — a name that intentionally falls outside this glob — because the file defines `@utility` declarations that must be available to other component CSS files via `@apply`. Defining them in a glob-picked-up `component.css` would cause a circular reference through `@reference "@src/css/index.css"`.

Instead, `rich-text-utils.css` is explicitly imported at the top of `assets/src/css/utils.css`:

```css
@import '../../../components/rich-text-utils/rich-text-utils.css';
```

**This import is required.** Without it, `@apply rich-text-h1` (and all other `rich-text-*` utilities) will fail at build time.

When installing via the shadpress generator, this import is added automatically via `postInstall`. If installing manually, add it yourself.
