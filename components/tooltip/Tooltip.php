<?php

namespace Theme\Components;

class Tooltip extends BaseComponent {

    public function __construct(
        public string $trigger_label = '',
        public string $tooltip_content = '',
        public string $side = 'top',
        public array $extra_attrs = []
    ) {
    }

    public static function enqueue_editor_assets(): void {
        $file = __DIR__ . '/tooltip-format.js';
        if (!file_exists($file))
            return;
        wp_enqueue_script(
            'shadpress-tooltip-format',
            get_theme_file_uri('components/tooltip/tooltip-format.js'),
            [
                'wp-rich-text',
                'wp-block-editor',
                'wp-components',
                'wp-element',
                'wp-i18n'
            ],
            filemtime($file)
        );
    }

    public static function register(): void {
        add_filter('wp_kses_allowed_html', [self::class, 'allow_tooltip_format_attrs'], 10, 2);
    }

    public static function allow_tooltip_format_attrs(array $allowed, string $context): array {
        if ($context === 'post') {
            $allowed['span']['x-data'] = true;
            $allowed['span']['data-component'] = true;
            $allowed['span']['data-tooltip-content'] = true;
            $allowed['span']['data-side'] = true;
            $allowed['span']['data-slot'] = true;
            $allowed['span']['tabindex'] = true;
            $allowed['span']['aria-describedby'] = true;
        }
        return $allowed;
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => 'tooltip',
            'data-tooltip-content' => esc_attr($this->tooltip_content),
            'data-side' => $this->side ? esc_attr($this->side) : null,
            ...$this->extra_attrs,
        ];
    }
}
