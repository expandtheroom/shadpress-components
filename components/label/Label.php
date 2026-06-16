<?php

namespace Theme\Components;

class Label extends BaseComponent {

    public function __construct(
        public string $text = '',
        public string $label_for = '',
        public bool $required = false,
        public string $id = '',
        public array $extra_attrs = []
    ) {
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            'for' => $this->label_for ?: null,
            'id' => $this->id ?: null,
            ...$this->extra_attrs,
        ];
    }

}
