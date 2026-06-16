<?php

namespace Theme\Components;

class ComboboxField extends BaseComponent {

    public ?Label $label_component = null;

    public function __construct(
        public string $name        = '',
        public string $placeholder = 'Search...',
        public array  $options     = [],
        public string $label       = '',
        public string $label_for   = '',
        public string $description  = '',
        public bool   $required     = false,
        public string $error        = '',
        public array  $extra_attrs  = []
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

    public function options_json(): string {
        $safe = array_map(function ($option) {
            return [
                'label' => $option['label'] ?? '',
                'value' => $option['value'] ?? '',
            ];
        }, $this->options);
        return wp_json_encode($safe) ?: '[]';
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->label_for ? $this->label_for . '-error' : '';
    }
}
