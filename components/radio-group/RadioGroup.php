<?php

namespace Theme\Components;

class RadioGroup extends BaseComponent {

    public function __construct(
        public string $name          = '',
        public string $label         = '',
        public array  $options       = [],
        public string $default_value = '',
        public bool   $disabled      = false,
        public string $orientation   = 'vertical',
        public array  $extra_attrs   = []
    ) {
    }
}
