<?php

namespace Theme\Components;

class Toggle extends BaseComponent {

    public ?Button $button_component = null;

    public function __construct(
        public string $label = '',
        public bool $checked = false,
        public string $variant = 'default',
        public string $size = 'default',
        public bool $disabled = false,
        public bool $required = false,
        public string $name = '',
        public string $value = '1',
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->button_component = new Button(
            variant: $this->variant,
            size: $this->size,
            label: $this->label,
            disabled: $this->disabled,
            extra_attrs: [
                'data-slot'    => 'toggle',
                'data-checked' => $this->checked ? 'true' : 'false',
                'data-value'   => $this->value,
                'aria-pressed' => $this->checked ? 'true' : 'false',
                ...($this->required ? ['aria-required' => 'true'] : []),
            ],
        );
    }
}
