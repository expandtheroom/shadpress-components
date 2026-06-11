<?php

namespace Theme\Components;

class CheckboxField extends BaseComponent {

    public BaseComponent $control_component;

    public function __construct(
        public string $variant = 'checkbox',
        public string $label = '',
        public string $description = '',
        public bool $required = false,
        public string $error = '',
        public string $name = '',
        public string $value = '1',
        public bool $checked = false,
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->control_component = $this->variant === 'switch-toggle'
            ? new SwitchToggle(
                label: $this->label,
                name: $this->name,
                checked: $this->checked,
                required: $this->required,
            )
            : new Checkbox(
                label: $this->label,
                name: $this->name,
                value: $this->value,
                checked: $this->checked,
                required: $this->required,
            );
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
