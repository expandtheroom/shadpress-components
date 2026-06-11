<?php

namespace Theme\Components;

class Typography extends BaseComponent {

    public function __construct(
        public string $body = '',
        public string $variant = 'default',
        public array $extra_attrs = []
    ) {
    }

    protected function set_attrs(): array {
        return [
            'data-variant' => $this->variant,
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
