<?php

namespace Theme\Components;

class NativeSelectField extends BaseComponent {

    public Label $label_component;
    public NativeSelect $control_component;

    public function __construct(
        public string $label = '',
        public string $label_for = '',
        public string $description = '',
        public bool $required = false,
        public string $error = '',
        public string $name = '',
        public string $placeholder = '',
        public array $options = [],
        public bool $disabled = false,
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->label_component = new Label(
            text: $this->label,
            label_for: $this->label_for,
            required: $this->required,
        );

        $error_attrs = array_filter([
            'aria-invalid'     => $this->has_error() ? 'true' : null,
            'aria-describedby' => $this->has_error() && $this->error_id() ? $this->error_id() : null,
        ]);

        $this->control_component = new NativeSelect(
            name: $this->name,
            id: $this->label_for,
            placeholder: $this->placeholder,
            options: $this->options,
            required: $this->required,
            disabled: $this->disabled,
            extra_attrs: $error_attrs,
        );
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
            ...$this->extra_attrs,
        ];
    }

}
