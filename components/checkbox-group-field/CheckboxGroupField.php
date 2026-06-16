<?php

namespace Theme\Components;

class CheckboxGroupField extends BaseComponent {

    public ?Label $label_component = null;
    /** @var BaseComponent[] */
    public array $checkbox_components = [];

    public function __construct(
        public string $description = '',
        public string $error = '',
        public string $label = '',
        public string $label_for = '',
        public string $name = '',
        public array  $options = [],  // each: ['label' => '', 'value' => '', 'checked' => false]
        public string $orientation = 'vertical',
        public bool   $required = false,
        public string $variant = 'checkbox',
        public array  $extra_attrs = []
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

        foreach ($this->options as $option) {
            $this->checkbox_components[] = match ($this->variant) {
                'toggle-group' => new Toggle(
                    label: $option['label'] ?? '',
                    name: $this->name . '[]',
                    value: $option['value'] ?? '',
                    checked: (bool) ($option['checked'] ?? false),
                    disabled: (bool) ($option['disabled'] ?? false),
                ),
                default => new Checkbox(
                    label: $option['label'] ?? '',
                    name: $this->name . '[]',
                    value: $option['value'] ?? '',
                    checked: (bool) ($option['checked'] ?? false),
                    disabled: (bool) ($option['disabled'] ?? false),
                ),
            };
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
