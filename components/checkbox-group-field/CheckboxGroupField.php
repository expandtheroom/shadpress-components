<?php

namespace Theme\Components;

class CheckboxGroupField extends BaseComponent {

    public string $id = '';
    public string $name = '';
    public ?Label $label_component = null;
    /** @var BaseComponent[] */
    public array $checkbox_components = [];

    public function __construct(
        public string $description = '',
        public string $error = '',
        public string $label = '',
        public array $options = [],  // each: ['label' => '', 'value' => '', 'checked' => false]
        public string $orientation = 'horizontal',
        public bool $required = false,
        public string $variant = 'checkbox',
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->id = sanitize_title($this->label);
        $this->name = $this->id;

        if ($this->label !== '') {
            $this->label_component = new Label(
                text: $this->label,
                label_for: $this->id,
                id: $this->id . '-label',
                required: $this->required,
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

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->id ? $this->id . '-error' : '';
    }
}
