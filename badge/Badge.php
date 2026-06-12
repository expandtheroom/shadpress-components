<?php

namespace Theme\Components;

class Badge extends BaseComponent {

    public function __construct(
        public string   $label             = '',
        public string   $variant           = 'default',
        public bool|int $include_icon      = 0,
        public string   $icon_provider     = '',
        public string   $icon_lucide_icons = '',
        public string   $icon_image_icon   = '',
        public string   $icon_position     = 'left',
        public array    $extra_attrs       = []
    ) {
    }

    public function badge_classes(): string {
        $base = 'inline-flex items-center justify-center rounded-full border px-2.5 py-0.5 text-xs font-semibold w-fit whitespace-nowrap shrink-0 transition-[color,box-shadow] focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50';

        $variant_classes = match ($this->variant) {
            'secondary'   => 'border-transparent bg-secondary text-secondary-foreground',
            'destructive' => 'border-transparent bg-destructive text-white focus-visible:ring-destructive/20',
            'outline'     => 'text-foreground',
            default       => 'border-transparent bg-primary text-primary-foreground',
        };

        return "$base $variant_classes";
    }

    public function render_icon(): string {
        static $providers = null;
        if ($providers === null) {
            $providers = apply_filters('theme/icon_providers', []);
        }
        if (empty($providers)) return '';
        $provider_key = !empty($this->icon_provider) ? $this->icon_provider : (string) array_key_first($providers);
        $provider     = $providers[$provider_key] ?? null;
        if (!$provider || !isset($provider['render'])) return '';
        $field = 'icon_' . str_replace('-', '_', $provider_key);
        return ($provider['render'])($this->$field ?? '');
    }

    public static function register(): void {
        add_filter('the_content', [self::class, 'process_format_icons']);
    }

    public static function process_format_icons(string $content): string {
        if (!str_contains($content, 'shadpress-badge')) return $content;

        $providers = apply_filters('theme/icon_providers', []);
        if (empty($providers)) return $content;

        return preg_replace_callback(
            '/<span\b([^>]*)>(.*?)<\/span>/s',
            function ($matches) use ($providers) {
                $attrs_str = $matches[1];
                $inner     = $matches[2];

                if (!str_contains($attrs_str, 'shadpress-badge')) return $matches[0];

                preg_match('/\bdata-icon="([^"]*)"/', $attrs_str, $icon_match);
                $icon_value = $icon_match[1] ?? '';
                if (empty($icon_value)) return $matches[0];

                preg_match('/\bdata-icon-provider="([^"]*)"/', $attrs_str, $prov_match);
                $provider_key = !empty($prov_match[1]) ? $prov_match[1] : (string) array_key_first($providers);

                preg_match('/\bdata-icon-position="([^"]*)"/', $attrs_str, $pos_match);
                $position = !empty($pos_match[1]) ? $pos_match[1] : 'left';

                $provider = $providers[$provider_key] ?? null;
                if (!$provider || !isset($provider['render'])) return $matches[0];

                $svg = ($provider['render'])($icon_value);
                if (empty($svg)) return $matches[0];

                $inner_with_icon = $position === 'right' ? $inner . $svg : $svg . $inner;

                return '<span' . $attrs_str . '>' . $inner_with_icon . '</span>';
            },
            $content
        );
    }

    public static function enqueue_editor_assets(): void {
        $file = __DIR__ . '/badge-format.js';
        if (!file_exists($file))
            return;
        wp_enqueue_script(
            'shadpress-badge-format',
            get_theme_file_uri('components/badge/badge-format.js'),
            ['wp-rich-text', 'wp-block-editor', 'wp-components', 'wp-element', 'wp-i18n'],
            filemtime($file)
        );

        $providers = apply_filters('theme/icon_providers', []);
        wp_localize_script('shadpress-badge-format', 'shadpressBadgeFormat', [
            'iconProviders' => array_values(array_map(
                fn($p) => ['key' => $p['key'], 'label' => $p['label']],
                $providers
            )),
        ]);
    }

    protected function set_attrs(): array {
        return [
            'data-variant' => $this->variant,
            'data-slot'    => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
