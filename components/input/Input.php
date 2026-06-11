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

    public function input_classes(): string {
        return 'file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 aria-invalid:border-destructive flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 md:text-sm';
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
