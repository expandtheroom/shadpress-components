<?php

namespace Theme\Components;

class Tabs extends BaseComponent {

    public function __construct(
        public array  $tabs          = [],
        public string $icon_provider = '',
        public string $icon_position = 'left',
        public array  $extra_attrs   = []
    ) {
    }

    /** @var Typography[] */
    public array $tab_contents = [];

    public function prepare(): void {
        $this->tab_contents = array_map(
            fn(array $tab) => new Typography(body: $tab['content'] ?? ''),
            $this->tabs,
        );
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }

    public function render_tab_icon(array $tab): string {
        if (empty($tab['include_icon'])) return '';
        static $providers = null;
        if ($providers === null) {
            $providers = apply_filters('theme/icon_providers', []);
        }
        if (empty($providers)) return '';
        $provider_key = !empty($this->icon_provider) ? $this->icon_provider : (string) array_key_first($providers);
        $provider     = $providers[$provider_key] ?? null;
        if (!$provider || !isset($provider['render'])) return '';
        $field = 'icon_' . str_replace('-', '_', $provider_key);
        return ($provider['render'])($tab[$field] ?? '');
    }

}
