<?php

namespace Theme\Components;

class ToggleGroup extends BaseComponent {

    public string $id = '';
    public ?Label $label_component = null;

    /** @var Toggle[] */
    public array $toggle_components = [];

    public function __construct(
        public string $label = '',
        public array $options = [],  // each: ['label' => '', 'value' => '', 'checked' => false, 'disabled' => false]
        public string $orientation = 'horizontal',
        public string $layout = 'separate',    // conjoined | separate
        public string $variant = 'default',    // Button variant passed through to Toggle → Button
        public string $size = 'default',
        public bool $multiple = true,          // true = multi-select, false = single-select
        public string $description = '',
        public string $error = '',
        public bool $required = false,
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->id = sanitize_title($this->label);

        if ($this->label !== '') {
            $this->label_component = new Label(
                text: $this->label,
                label_for: $this->id,
                id: "{$this->id}-label",
                required: $this->required,
            );
        }

        $this->toggle_components = array_map(
            fn(array $option) => new Toggle(
                variant: $this->variant,
                size: $this->size,
                label: $option['label'] ?? '',
                checked: (bool) ($option['checked'] ?? false),
                disabled: (bool) ($option['disabled'] ?? false),
                value: $option['value'] ?? '',
            ),
            $this->options,
        );
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->id ? "{$this->id}-error" : '';
    }
}
