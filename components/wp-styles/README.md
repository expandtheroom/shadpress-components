# WP Styles

CSS-only component. No PHP class, no template. Styles Gutenberg block output on the front end and in the block editor by mapping `wp-block-*` selectors to [`rich-text-*` utilities](../rich-text-utils/README.md).

## Files

| File | What it styles |
|---|---|
| `wp-block-heading.css` | `h1–h6.wp-block-heading` |
| `wp-block-paragraph.css` | `.wp-block-paragraph` |
| `wp-block-list.css` | `ul/ol.wp-block-list`, `.wp-block-list > li` |
| `wp-block-quote.css` | `blockquote.wp-block-quote` |
| `wp-block-separator.css` | `.wp-block-separator` |
| `wp-block-code.css` | `pre.wp-block-code` |
| `wp-block-table.css` | `figure.wp-block-table`, `table`, `th`, `td`, `figcaption` |
| `wp-block-image.css` | `figure.wp-block-image`, `img`, `figcaption`, alignment variants |
| `wp-link.css` | `a:where(:not(.wp-element-button, .button, .btn))` — page-wide link style |
| `wp-gutenberg-editor.css` | Editor wrapper layout (`editor-styles-wrapper`) |
| `wp-theme-etr-starter-theme.css` | `body.wp-theme-etr-starter-theme` layout |

## Notes

- **Link scope:** `wp-link.css` applies to all links page-wide except those with button-like classes. Scope to `.entry-content` if nav or other non-content links should be excluded.
- **Block editor:** styles load in the editor via `wp-gutenberg-editor.css`. Block-specific files affect the editor too wherever WP applies the same selectors inside `.editor-styles-wrapper`.
