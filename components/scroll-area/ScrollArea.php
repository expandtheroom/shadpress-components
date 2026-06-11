<?php

namespace Theme\Components;

class ScrollArea extends BaseComponent {

    public ?Typography $body_component = null;

    public function __construct(
        public string $body        = '',
        public string $max_height  = '300px',
        public string $orientation = 'vertical',
        public array  $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->body_component = new Typography(body: $this->body);
    }
}
