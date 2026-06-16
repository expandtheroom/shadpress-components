<?php

namespace Theme\Components;

class Select extends BaseComponent {

    public function __construct(
        public string $name = '',
        public string $id = '',
        public string $placeholder = '',
        public array $options = [],
        public bool $required = false,
        public bool $disabled = false,
        public array $extra_attrs = []
    ) {
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            'name' => $this->name ? esc_attr($this->name) : null,
            'id' => $this->id ? esc_attr($this->id) : null,
            'required' => $this->required ? 'required' : null,
            'disabled' => $this->disabled ? 'disabled' : null,
            ...$this->extra_attrs,
        ];
    }
}
