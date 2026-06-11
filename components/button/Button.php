<?php

namespace Theme\Components;

class Button extends BaseComponent {

    public function __construct(
        public string $variant = 'default',
        public string $size = 'default',
        public array|string $link = [],
        public string $label = '',
        public bool|int $disabled = 0,
        public string $type = 'button',
        public string $click_action = '',
        public string $alpine_module = '',
        public bool|int $include_icon = 0,
        public string $icon_provider     = '',
        public string $icon_lucide_icons = '',
        public string $icon_image_icon   = '',
        public string $icon_position     = 'left',

        // non field properties
        public array $extra_attrs = []
    ) {
    }

    protected function set_attrs(): array {
        return [
            'data-variant' => $this->variant,
            'data-size' => $this->size,
            ...$this->extra_attrs,
        ];
    }

    public function button_classes(): string {
        $base = classNames(
            'inline-flex shrink-0 items-center justify-center gap-2 rounded-md',
            'text-sm font-medium whitespace-nowrap',
            'transition-color outline-none',
            'focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50',
            'cursor-pointer disabled:cursor-not-allowed',
            'disabled:pointer-events-none disabled:opacity-50',
            'aria-invalid:border-destructive aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40',
            '[&_svg]:pointer-events-none [&_svg:not([class*=\'size-\'])]:size-4 [&_svg]:shrink-0',
            '[&.align-center]:flex! [&.align-center]:align-self-center [&.align-center]:mx-auto',
            '[&.align-left]:flex! [&.align-left]:align-self-start [&.align-left]:mr-auto',
            '[&.align-right]:flex! [&.align-right]:align-self-end [&.align-right]:ml-auto',
        );

        $variant_classes = match ($this->variant) {
            'destructive' => 'bg-destructive text-white hover:bg-destructive/90 focus-visible:ring-destructive/20 dark:bg-destructive/60 dark:focus-visible:ring-destructive/40',
            'outline' => 'border bg-background shadow-xs hover:bg-accent hover:text-accent-foreground dark:border-input dark:bg-input/30 dark:hover:bg-input/50',
            'secondary' => 'bg-secondary text-secondary-foreground hover:bg-secondary/80',
            'ghost' => 'hover:bg-accent hover:text-accent-foreground dark:hover:bg-accent/50',
            'link' => 'text-primary underline-offset-4 hover:underline',
            default => 'bg-primary text-primary-foreground hover:bg-primary/90',
        };

        $size_classes = $this->variant === 'link' ? '' : match ($this->size) {
            'xs' => 'h-6 gap-1 rounded-md px-2 text-xs has-[>svg]:px-1.5 [&_svg:not([class*=\'size-\'])]:size-3',
            'sm' => 'h-8 gap-1.5 rounded-md px-3 has-[>svg]:px-2.5',
            'lg' => 'h-10 rounded-md px-6 has-[>svg]:px-4',
            'icon' => 'size-9',
            'icon-xs' => 'size-6 rounded-md [&_svg:not([class*=\'size-\'])]:size-3',
            'icon-sm' => 'size-8',
            'icon-lg' => 'size-10',
            default => 'h-9 px-4 py-2 has-[>svg]:px-3',
        };

        return "$base $variant_classes $size_classes";
    }

    public function render_icon(): string {
        static $providers = null; // cached for the lifetime of the request
        if ($providers === null) {
            $providers = apply_filters('theme/icon_providers', []);
        }
        if (empty($providers)) return '';
        // Fall back to first provider when icon_provider is empty (hidden field, never explicitly saved)
        $provider_key = !empty($this->icon_provider) ? $this->icon_provider : (string) array_key_first($providers);
        $provider     = $providers[$provider_key] ?? null;
        if (!$provider || !isset($provider['render'])) return '';
        $field = 'icon_' . str_replace('-', '_', $provider_key);
        return ($provider['render'])($this->$field ?? '');
    }
}
