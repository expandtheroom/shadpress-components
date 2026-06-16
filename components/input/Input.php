<?php

namespace Theme\Components;

class Input extends BaseComponent {
    public array $allowed_types = ['text', 'email', 'password', 'number', 'tel', 'url', 'search'];

    public function __construct(
        public string $type = 'text',
        public string $name = '',
        public string $id = '',
        public string $placeholder = '',
        public string $default_value = '',
        public bool $required = false,
        public bool $disabled = false,
        public bool $readonly = false,
        public array $extra_attrs = []
    ) {
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            'type' => in_array($this->type, $this->allowed_types, true) ? $this->type : 'text',
            'name' => $this->name ?: null,
            'id' => $this->id ?: null,
            'placeholder' => $this->placeholder ?: null,
            'value' => $this->default_value ?: null,
            'required' => $this->required ? 'required' : null,
            'disabled' => $this->disabled ? 'disabled' : null,
            'readonly' => $this->readonly ? 'readonly' : null,
            ...$this->extra_attrs,
        ];
    }
}
