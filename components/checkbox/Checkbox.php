<?php

namespace Theme\Components;

class Checkbox extends BaseComponent {

    public function __construct(
        public bool $checked = false,
        public bool $disabled = false,
        public string $label = '',
        public string $name = '',
        public bool $required = false,
        public string $value = '1',

        public array $extra_attrs = []
    ) {
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug() . '-root',
            'data-checked' => $this->checked ? 'true' : 'false',
            'data-name' => $this->name ? esc_attr($this->name) : ($this->label ? esc_attr($this->label) : null),
            'data-value' => $this->value ? esc_attr($this->value) : null,
            'data-disabled' => $this->disabled ? 'true' : 'false',
            ...$this->extra_attrs,
        ];
    }
}
