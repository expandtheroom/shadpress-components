<?php

namespace Theme\Components;

class HelloWorld extends BaseComponent {
    public string $title_uppercase = '';

    public function __construct(
        public string $title = '',
    ) {
        $this->title = trim($title);
        $this->title_uppercase = strtoupper($this->title);
    }
}
