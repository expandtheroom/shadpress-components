<?php

namespace Theme\Components;

class Accordion extends BaseComponent {

    public function __construct(
        public array  $panels       = [],
        public string $type         = 'single',
        public bool|int $include_icon  = 0,
        public string   $icon_provider = '',

        // non-field properties
        public array $extra_attrs = [],
    ) {
    }

    /** @var Typography[] */
    public array $panel_contents = [];

    public function prepare(): void {
        $this->panel_contents = array_map(
            fn(array $panel) => new Typography(body: $panel['content'] ?? ''),
            $this->panels,
        );
    }

    public function render_panel_icon(array $panel): string {
        if (empty($this->include_icon)) return '';
        static $providers = null;
        if ($providers === null) {
            $providers = apply_filters('theme/icon_providers', []);
        }
        if (empty($providers)) return '';
        $provider_key = !empty($this->icon_provider) ? $this->icon_provider : (string) array_key_first($providers);
        $provider     = $providers[$provider_key] ?? null;
        if (!$provider || !isset($provider['render'])) return '';
        $field = 'icon_' . str_replace('-', '_', $provider_key);
        return ($provider['render'])($panel[$field] ?? '');
    }

    protected function set_attrs(): array {
        return [
            'data-type' => $this->type,
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
