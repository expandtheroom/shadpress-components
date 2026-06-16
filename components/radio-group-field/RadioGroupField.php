<?php

namespace Theme\Components;

class RadioGroupField extends BaseComponent {

    public ?Label $label_component = null;

    public function __construct(
        public string $name = '',
        public string $label = '',
        public array $options = [],
        public string $default_value = '',
        public bool $disabled = false,
        public string $orientation = 'vertical',
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
                required: $this->required,
                id: $this->label_id(),
            );
        }
    }

    public function label_id(): string {
        if ($this->label_for) {
            return $this->label_for;
        }

        return $this->name ? $this->name . '-label' : '';
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->label_for ? $this->label_for . '-error' : '';
    }
}
