<?php

namespace Theme\Components;

class Accordion extends BaseComponent {

    public function __construct(
        public array $panels = [],
        public string $type = 'single',

        // non-field properties
        public array $extra_attrs = [],
    ) {
    }

    /** @var Typography[] */
    public array $panel_contents = [];

    public function prepare(): void {
        $this->panel_contents = array_map(
            fn(array $panel) => new Typography(body: $panel['content'] ?? ''),
            $this->panels,
        );
    }

    protected function set_attrs(): array {
        return [
            'data-type' => $this->type,
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
