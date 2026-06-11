<?php

namespace Theme\Components;

class Tabs extends BaseComponent {

    public function __construct(
        public array $tabs = [],
        public array $extra_attrs = []
    ) {
    }

    /** @var Typography[] */
    public array $tab_contents = [];

    public function prepare(): void {
        $this->tab_contents = array_map(
            fn(array $tab) => new Typography(body: $tab['content'] ?? ''),
            $this->tabs,
        );
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }

}
