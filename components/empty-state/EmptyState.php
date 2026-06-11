<?php

namespace Theme\Components;

class EmptyState extends BaseComponent {

    public function __construct(
        public string $title = '',
        public string $description = '',
        public array $action_link = [],
        public array $extra_attrs = []
    ) {
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
