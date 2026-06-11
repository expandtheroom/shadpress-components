<?php

namespace Theme\Components;

class DatePicker extends BaseComponent {

    public function __construct(
        public string $name          = '',
        public string $label         = '',
        public string $placeholder   = 'Pick a date',
        public string $selected_date = '',
        public string $min_date      = '',
        public string $max_date      = '',
        public array  $extra_attrs   = []
    ) {
    }

    public function prepare(): void {
        if ($this->placeholder === '') {
            $this->placeholder = 'Pick a date';
        }
    }
}
