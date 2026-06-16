<?php

namespace Theme\Components;

class DatePickerField extends BaseComponent {

    public ?Label $label_component = null;

    public function __construct(
        public string $name          = '',
        public string $label         = '',
        public string $placeholder   = 'Pick a date',
        public string $selected_date = '',
        public string $min_date      = '',
        public string $max_date      = '',
        public string $label_for     = '',
        public string $description   = '',
        public bool   $required      = false,
        public string $error         = '',
        public array  $extra_attrs   = []
    ) {
    }

    public function prepare(): void {
        if ($this->placeholder === '') {
            $this->placeholder = 'Pick a date';
        }

        if ($this->label !== '') {
            $this->label_component = new Label(
                text: $this->label,
                label_for: $this->trigger_id(),
                required: $this->required,
            );
        }
    }

    public function trigger_id(): string {
        if ($this->label_for) {
            return $this->label_for;
        }

        return $this->name ? 'date-picker-' . $this->name : '';
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->trigger_id() ? $this->trigger_id() . '-error' : '';
    }

    protected function set_attrs(): array {
        return [
            'data-name' => $this->name ? esc_attr($this->name) : null,
            'data-label' => $this->label ? esc_attr($this->label) : null,
            'data-placeholder' => $this->placeholder ? esc_attr($this->placeholder) : null,
            'data-selected-date' => $this->selected_date ? esc_attr($this->selected_date) : null,
            'data-min-date' => $this->min_date ? esc_attr($this->min_date) : null,
            'data-max-date' => $this->max_date ? esc_attr($this->max_date) : null,
            ...$this->extra_attrs,
        ];
    }
}
