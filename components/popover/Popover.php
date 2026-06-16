<?php

namespace Theme\Components;

class Popover extends BaseComponent {

    public ?Typography $body_component = null;

    public function __construct(
        public string $trigger_label = '',
        public string $body = '',
        public string $side = 'bottom',
        public string $align = 'center',
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->body_component = new Typography(body: $this->body);
    }

    protected function set_attrs(): array {
        return [
            'data-side' => $this->side ? esc_attr($this->side) : 'bottom',
            'data-align' => $this->align ? esc_attr($this->align) : 'center',
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
