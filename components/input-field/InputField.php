<?php

namespace Theme\Components;

class InputField extends BaseComponent {

    public Label $label_component;
    public Input $control_component;

    public function __construct(
        public string $label = '',
        public string $label_for = '',
        public string $description = '',
        public bool $required = false,
        public string $error = '',
        public string $field_type = 'text',
        public string $name = '',
        public string $placeholder = '',
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

        $this->control_component = new Input(
            type: $this->field_type,
            name: $this->name,
            id: $this->label_for,
            placeholder: $this->placeholder,
            required: $this->required,
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
