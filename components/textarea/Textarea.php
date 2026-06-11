<?php

namespace Theme\Components;

class Textarea extends BaseComponent {

    public function __construct(
        public string $name = '',
        public string $id = '',
        public string $placeholder = '',
        public int $rows = 4,
        public bool $required = false,
        public bool $disabled = false,
        public bool $readonly = false,
        public array $extra_attrs = []
    ) {
    }

    public function textarea_classes(): string {
        return 'placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 aria-invalid:border-destructive flex min-h-16 w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 md:text-sm field-sizing-content';
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            'name' => $this->name ? esc_attr($this->name) : null,
            'id' => $this->id ? esc_attr($this->id) : null,
            'placeholder' => $this->placeholder ? esc_attr($this->placeholder) : null,
            'rows' => esc_attr((string) $this->rows),
            'required' => $this->required ? 'required' : null,
            'disabled' => $this->disabled ? 'disabled' : null,
            'readonly' => $this->readonly ? 'readonly' : null,
            ...$this->extra_attrs,
        ];
    }
}
