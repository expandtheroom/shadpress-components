<?php

namespace Theme\Components;

class StyledSelectField extends BaseComponent {

    public ?Label $label_component = null;

    public function __construct(
        public string $name = '',
        public string $placeholder = 'Select an option',
        public array $options = [],
        public bool $disabled = false,
        public string $label = '',
        public string $label_for = '',
        public string $description = '',
        public bool $required = false,
        public string $error = '',
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        if ($this->label !== '') {
            $this->label_component = new Label(
                text: $this->label,
                label_for: $this->label_for,
                required: $this->required,
            );
        }
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->label_for ? $this->label_for . '-error' : '';
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            'data-name' => $this->name ? esc_attr($this->name) : null,
            'data-placeholder' => $this->placeholder ?: null,
            'data-value' => $this->default_value ?: null,
            'data-disabled' => $this->disabled ? 'disabled' : null,
            ...$this->extra_attrs,
        ];
    }
}
