<?php

namespace Theme\Components;

class Popover extends BaseComponent {

    public ?Typography $body_component = null;

    public function __construct(
        public string $trigger_label = '',
        public string $body          = '',
        public string $side          = 'bottom',
        public string $align         = 'center',
        public array  $extra_attrs   = []
    ) {
    }

    public function prepare(): void {
        $this->body_component = new Typography(body: $this->body);
    }

    public function popover_content_classes(): string {
        return 'absolute z-50 w-72 rounded-md border p-4 text-sm shadow-md outline-none';
    }
}
