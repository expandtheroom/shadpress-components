<?php

namespace Theme\Components;

class SwitchToggle extends BaseComponent {

    public function __construct(
        public string $label = '',
        public string $name = '',
        public string $value = '1',
        public bool $checked = false,
        public bool $required = false,
        public bool $disabled = false,
        public array $extra_attrs = []
    ) {
    }

}
