<?php

namespace Theme\Components;

class DatePickerField extends BaseComponent {

    public string $id = '';
    public string $name = '';
    public ?Label $label_component = null;

    public function __construct(
        public string $label         = '',
        public string $placeholder   = 'Pick a date',
        public string $selected_date = '',
        public string $min_date      = '',
        public string $max_date      = '',
        public string $description   = '',
        public bool   $required      = false,
        public string $error         = '',
        public array  $extra_attrs   = []
    ) {
    }

    public function prepare(): void {
        $this->id   = sanitize_title($this->label);
        $this->name = $this->id;

        if ($this->placeholder === '') {
            $this->placeholder = 'Pick a date';
        }

        if ($this->label !== '') {
            $this->label_component = new Label(
                text: $this->label,
                label_for: $this->id,
                id: $this->id . '-label',
                required: $this->required,
            );
        }
    }

    public function has_error(): bool {
        return $this->error !== '';
    }

    public function error_id(): string {
        return $this->id ? $this->id . '-error' : '';
    }

    protected function set_attrs(): array {
        return [
            'data-name'          => esc_attr($this->name),
            'data-label'         => $this->label ? esc_attr($this->label) : null,
            'data-placeholder'   => $this->placeholder ? esc_attr($this->placeholder) : null,
            'data-selected-date' => $this->selected_date ? esc_attr($this->selected_date) : null,
            'data-min-date'      => $this->min_date ? esc_attr($this->min_date) : null,
            'data-max-date'      => $this->max_date ? esc_attr($this->max_date) : null,
            ...$this->extra_attrs,
        ];
    }
}
