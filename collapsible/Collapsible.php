<?php

namespace Theme\Components;

class Collapsible extends BaseComponent {

    public ?Typography $body_component = null;

    public function __construct(
        public string   $trigger_label     = '',
        public string   $body              = '',
        public bool     $open              = false,
        public bool|int $include_icon      = 0,
        public string   $icon_provider     = '',
        public string   $icon_lucide_icons = '',
        public string   $icon_image_icon   = '',
        public array    $extra_attrs       = []
    ) {
    }

    public function prepare(): void {
        $this->body_component = new Typography(body: $this->body);
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
}
