<?php

namespace Theme\Components;

class Menubar extends BaseComponent {

    public function __construct(
        public string $label       = '',
        public array  $menus       = [],
        public array  $extra_attrs = []
    ) {
    }

    protected function set_attrs(): array {
        return [
            'data-type' => $this->type,
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
