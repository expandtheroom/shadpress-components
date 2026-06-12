<?php

namespace Theme\Components;

class Dialog extends BaseComponent {

    public ?Button $trigger_button = null;

    public function __construct(
        public string   $trigger_label             = '',
        public string   $title                     = '',
        public string   $description               = '',
        public string   $trigger_variant           = 'outline',
        public bool|int $trigger_include_icon      = 0,
        public string   $trigger_icon_provider     = '',
        public string   $trigger_icon_lucide_icons = '',
        public string   $trigger_icon_image_icon   = '',
        public string   $trigger_icon_position     = 'left',
        public bool|int $header_include_icon       = 0,
        public string   $header_icon_provider      = '',
        public string   $header_icon_lucide_icons  = '',
        public string   $header_icon_image_icon    = '',
        public string   $dialog_content            = '',
        public string   $close_label               = 'Close',
        public array    $extra_attrs               = []
    ) {
    }

    public ?Typography $content_component = null;

    public function prepare(): void {
        $this->content_component = new Typography(body: $this->dialog_content);

        $this->trigger_button = new Button(
            variant:           $this->trigger_variant,
            label:             $this->trigger_label,
            include_icon:      $this->trigger_include_icon,
            icon_provider:     $this->trigger_icon_provider,
            icon_lucide_icons: $this->trigger_icon_lucide_icons,
            icon_image_icon:   $this->trigger_icon_image_icon,
            icon_position:     $this->trigger_icon_position,
            extra_attrs: [
                'data-slot' => 'dialog-trigger',
                '@click'    => 'open = true',
            ]
        );
    }

    public function render_header_icon(): string {
        static $providers = null;
        if ($providers === null) {
            $providers = apply_filters('theme/icon_providers', []);
        }
        if (empty($providers)) return '';
        $provider_key = !empty($this->header_icon_provider)
            ? $this->header_icon_provider
            : (string) array_key_first($providers);
        $provider = $providers[$provider_key] ?? null;
        if (!$provider || !isset($provider['render'])) return '';
        $field = 'header_icon_' . str_replace('-', '_', $provider_key);
        return ($provider['render'])($this->$field ?? '');
    }

    public function trigger_classes(): string {
        $base = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all cursor-pointer focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2';

        $variant = match ($this->trigger_variant) {
            'outline' => 'border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground',
            'secondary' => 'bg-secondary text-secondary-foreground shadow-xs hover:bg-secondary/80',
            'ghost' => 'hover:bg-accent hover:text-accent-foreground',
            default => 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90',
        };

        return "$base $variant";
    }

}
