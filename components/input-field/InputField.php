<?php

namespace Theme\Components;

class InputField extends BaseComponent {

    public string $id = '';
    public string $name = '';
    public Label $label_component;
    public Input $control_component;

    public function __construct(
        public string $label = '',
        public string $description = '',
        public bool $required = false,
        public string $error = '',
        public string $field_type = 'text',
        public string $placeholder = '',
        public string $prefix = '',
        public string $suffix = '',
        public bool $disabled = false,
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->id   = sanitize_title($this->label);
        $this->name = $this->id;

        $this->label_component = new Label(
            text: $this->label,
            label_for: $this->id,
            id: $this->id . '-label',
            required: $this->required,
        );

        $error_attrs = array_filter([
            'aria-invalid'     => $this->has_error() ? 'true' : null,
            'aria-describedby' => $this->has_error() && $this->error_id() ? $this->error_id() : null,
        ]);

        $this->control_component = new Input(
            type: $this->field_type,
            name: $this->name,
            id: $this->id,
            placeholder: $this->placeholder,
            required: $this->required,
            disabled: $this->disabled,
            extra_attrs: $error_attrs,
        );
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->id ? $this->id . '-error' : '';
    }

    public function has_addons(): bool {
        return $this->prefix !== '' || $this->suffix !== '';
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }

}
