<?php

namespace Theme\Components;

class ToggleGroup extends BaseComponent {

    public function __construct(
        public string $type          = 'single',
        public array  $toggles       = [],
        public string $default_value = '',
        public string $label         = '',
        public array  $extra_attrs   = []
    ) {
    }
}
