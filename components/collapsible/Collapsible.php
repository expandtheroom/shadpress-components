<?php

namespace Theme\Components;

class Collapsible extends BaseComponent {

    public ?Typography $body_component = null;

    public function __construct(
        public string $trigger_label = '',
        public string $body          = '',
        public bool   $open          = false,
        public array  $extra_attrs   = []
    ) {
    }

    public function prepare(): void {
        $this->body_component = new Typography(body: $this->body);
    }
}
