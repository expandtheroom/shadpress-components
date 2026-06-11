<?php

namespace Theme\Components;

class Calendar extends BaseComponent {

    public function __construct(
        public string $name          = '',
        public string $selected_date = '',
        public string $min_date      = '',
        public string $max_date      = '',
        public array  $extra_attrs   = []
    ) {
    }
}
