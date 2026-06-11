<?php

namespace Theme\Components;

class NativeSelect extends BaseComponent {

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

    public function select_classes(): string {
        return 'flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring aria-invalid:ring-destructive/20 aria-invalid:border-destructive disabled:cursor-not-allowed disabled:opacity-50 md:text-sm';
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
