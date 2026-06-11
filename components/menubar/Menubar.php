<?php

namespace Theme\Components;

class Menubar extends BaseComponent {

    public function __construct(
        public string $label       = '',
        public array  $menus       = [],
        public array  $extra_attrs = []
    ) {
    }
}
