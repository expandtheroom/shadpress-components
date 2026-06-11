<?php

namespace Theme\Components;

class HoverCard extends BaseComponent {

    public function __construct(
        public string $trigger_label = '',
        public string $trigger_url = '',
        public string $card_content = '',
        public string $side = 'bottom',
        public string $align = 'center',

        // non-field properties
        public array $extra_attrs = []
    ) {
    }

    public static function enqueue_editor_assets(): void {
        $file = __DIR__ . '/hover-card-format.js';
        wp_enqueue_script(
            'shadpress-hover-card-format',
            get_theme_file_uri('components/hover-card/hover-card-format.js'),
            ['wp-rich-text', 'wp-block-editor', 'wp-components', 'wp-element', 'wp-i18n'],
            filemtime($file)
        );
    }

    /** Returns absolute-position classes for the card panel based on side + align. */
    public function card_position_classes(): string {
        $is_horizontal = in_array($this->side, ['top', 'bottom'], true);

        $side_classes = match ($this->side) {
            'top' => 'bottom-full mb-2',
            'left' => 'right-full mr-2',
            'right' => 'left-full ml-2',
            default => 'top-full mt-2',  // bottom
        };

        $align_classes = match ($this->align) {
            'start' => $is_horizontal ? 'left-0' : 'top-0',
            'end' => $is_horizontal ? 'right-0' : 'bottom-0',
            default => $is_horizontal
                ? 'left-1/2 -translate-x-1/2'
                : 'top-1/2 -translate-y-1/2',
        };

        return "$side_classes $align_classes";
    }

    public static function register(): void {
        add_filter('wp_kses_allowed_html', function (array $allowed, string $context): array {
            if ($context === 'post') {
                $allowed['span']['x-data'] = true;
            }
            return $allowed;
        }, 10, 2);

        add_filter('the_content', function (string $content): string {
            if (!str_contains($content, 'shadpress-hover-card')) {
                return $content;
            }

            return preg_replace_callback(
                '/<span\s+class="shadpress-hover-card"([^>]*)>(.*?)<\/span>/s',
                function (array $matches): string {
                    $attrs_raw = $matches[1];
                    $trigger_label = wp_strip_all_tags($matches[2]);

                    preg_match_all('/data-([\w-]+)="([^"]*)"/', $attrs_raw, $attr_matches, PREG_SET_ORDER);
                    $attrs = [];
                    foreach ($attr_matches as $m) {
                        $attrs[$m[1]] = html_entity_decode($m[2], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    }

                    $card = new self(
                        trigger_label: $trigger_label,
                        card_content: $attrs['content'] ?? '',
                        side: $attrs['side'] ?? 'bottom',
                        align: $attrs['align'] ?? 'center',
                    );

                    return $card->render();
                },
                $content
            );
        }, 10, 1);
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            'data-content' => esc_attr(wp_kses_post($this->card_content)),
            'data-side' => esc_attr($this->side),
            'data-align' => esc_attr($this->align),
            ...$this->extra_attrs,
        ];
    }
}
