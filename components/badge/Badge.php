<?php

namespace Theme\Components;

class Badge extends BaseComponent {

    public function __construct(
        public string $label = '',
        public string $variant = 'default',
        public array $extra_attrs = []
    ) {
    }

    public function badge_classes(): string {
        $base = 'inline-flex items-center justify-center rounded-full border px-2.5 py-0.5 text-xs font-semibold w-fit whitespace-nowrap shrink-0 transition-[color,box-shadow] focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50';

        $variant_classes = match ($this->variant) {
            'secondary' => 'border-transparent bg-secondary text-secondary-foreground',
            'destructive' => 'border-transparent bg-destructive text-white focus-visible:ring-destructive/20',
            'outline' => 'text-foreground',
            default => 'border-transparent bg-primary text-primary-foreground',
        };

        return "$base $variant_classes";
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
    }

    protected function set_attrs(): array {
        return [
            'data-variant' => $this->variant,
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
