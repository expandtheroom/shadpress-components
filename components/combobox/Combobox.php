<?php

namespace Theme\Components;

class Combobox extends BaseComponent {

    public function __construct(
        public string $name        = '',
        public string $placeholder = 'Search...',
        public array  $options     = [],
        public array  $extra_attrs = []
    ) {
    }

    public function options_json(): string {
        $safe = array_map(function ($option) {
            return [
                'label' => $option['label'] ?? '',
                'value' => $option['value'] ?? '',
            ];
        }, $this->options);
        return wp_json_encode($safe) ?: '[]';
    }
}
