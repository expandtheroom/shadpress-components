<?php

namespace Theme\Components;

class Pagination extends BaseComponent {

    public function __construct(
        public int $mid_size = 2,
        public array $extra_attrs = []
    ) {
    }

    public function get_links(): array {
        $links = paginate_links([
            'type' => 'array',
            'mid_size' => $this->mid_size,
            'prev_text' => '&larr; Previous',
            'next_text' => 'Next &rarr;',
        ]);

        return $links ?? [];
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            'aria-label' => "Pagination",
            ...$this->extra_attrs,
        ];
    }
}
