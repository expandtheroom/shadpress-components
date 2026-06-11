<?php

namespace Theme\Components;

class Select extends BaseComponent {

    public function __construct(
        public string $name        = '',
        public string $placeholder = 'Select an option',
        public array  $options     = [],
        public bool   $disabled    = false,
        public array  $extra_attrs = []
    ) {
    }
}
