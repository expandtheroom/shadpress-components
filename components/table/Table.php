<?php

namespace Theme\Components;

class Table extends BaseComponent {

    public function __construct(
        public string $caption     = '',
        public array  $headers     = [],
        public array  $rows        = [],
        public array  $extra_attrs = []
    ) {
    }
}
