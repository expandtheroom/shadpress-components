<?php

namespace Theme\Components;

class RadioGroupField extends BaseComponent {

    public string $id = '';
    public string $name = '';
    public ?Label $label_component = null;

    public function __construct(
        public string $label = '',
        public array $options = [],
        public string $default_value = '',
        public bool $disabled = false,
        public string $orientation = 'horizontal',
        public string $description = '',
        public bool $required = false,
        public string $error = '',
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->id   = sanitize_title($this->label);
        $this->name = $this->id;

        if ($this->label !== '') {
            $this->label_component = new Label(
                text: $this->label,
                label_for: $this->id,
                id: $this->id . '-label',
                required: $this->required,
            );
        }
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->id ? $this->id . '-error' : '';
    }
}
