<?php

namespace Theme\Components;

class InputGroup extends BaseComponent {

    public Input $input;

    public function __construct(
        public string $prefix = '',
        public string $suffix = '',
        public string $type = 'text',
        public string $name = '',
        public string $id = '',
        public string $placeholder = '',
        public bool $required = false,
        public bool $disabled = false,
        public array $extra_attrs = [],
    ) {
    }

    public function prepare(): void {
        $this->input = new Input(
            type: $this->type,
            name: $this->name,
            id: $this->id,
            placeholder: $this->placeholder,
            required: $this->required,
            disabled: $this->disabled,
        );
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
