<?php

namespace Theme\Components;

class Separator extends BaseComponent {

    public function __construct(
        public string $orientation = 'horizontal',
        public bool   $decorative  = true,
        public array  $extra_attrs = []
    ) {
    }
}
