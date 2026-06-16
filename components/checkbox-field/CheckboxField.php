<?php

namespace Theme\Components;

class CheckboxField extends BaseComponent {

    public BaseComponent $control_component;

    public function __construct(
        public string $component = 'checkbox',
        public bool $checked = false,
        public string $description = '',
        public bool $disabled = false,
        public string $error = '',
        public string $label = '',
        public string $name = '',
        public bool $required = false,
        public string $value = '1',

        // size and variant are only applicable for toggle component
        public string $size = 'default',
        public string $variant = 'default',

        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->control_component = match ($this->component) {
            'switch-toggle' => new SwitchToggle(
                label: $this->label,
                name: $this->name,
                value: $this->value,
                checked: $this->checked,
                required: $this->required,
                disabled: $this->disabled,
            ),
            'toggle' => new Toggle(
                checked: $this->checked,
                disabled: $this->disabled,
                label: $this->label,
                name: $this->name,
                required: $this->required,
                size: $this->size,
                variant: $this->variant,
                value: $this->value,
            ),
            default => new Checkbox(
                label: $this->label,
                name: $this->name,
                value: $this->value,
                checked: $this->checked,
                required: $this->required,
                disabled: $this->disabled,
            ),
        };
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
