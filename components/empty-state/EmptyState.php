<?php

namespace Theme\Components;

class EmptyState extends BaseComponent {

    public ?Button $action_button = null;

    public function __construct(
        public string $title = '',
        public string $description = '',
        public array $action_link = [],
        public bool|int $include_icon = 0,
        public string $icon_provider = '',
        public string $icon_lucide_icons = '',
        public string $icon_image_icon = '',

        // non field properties
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        if (!$this->has_action()) {
            $this->action_button = null;
            return;
        }

        $this->action_button = new Button(
            link: $this->action_link,
            extra_attrs: [
                'data-slot' => 'empty-state-action',
            ],
        );
    }

    public function render_icon(): string {
        static $providers = null;
        if ($providers === null) {
            $providers = apply_filters('theme/icon_providers', []);
        }
        if (empty($providers))
            return '';
        $provider_key = !empty($this->icon_provider) ? $this->icon_provider : (string) array_key_first($providers);
        $provider = $providers[$provider_key] ?? null;
        if (!$provider || !isset($provider['render']))
            return '';
        $field = 'icon_' . str_replace('-', '_', $provider_key);
        return ($provider['render'])($this->$field ?? '');
    }

    public function has_action(): bool {
        return !empty($this->action_link['url']);
    }

    public function component_attrs(): string {
        $default_attrs = [
            'data-component' => $this->component_slug(),
        ];

        $compiled_attrs = [];
        foreach (array_merge($default_attrs, $this->extra_attrs) as $key => $value) {
            $compiled_attrs[] = esc_attr($key) . '="' . esc_attr($value) . '"';
        }

        $compiled_attrs[] = $this->get_anchor_attr();

        return implode(' ', array_filter($compiled_attrs));
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
