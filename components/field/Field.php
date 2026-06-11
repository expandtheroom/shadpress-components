<?php

namespace Theme\Components;

class Field extends BaseComponent {

    public BaseComponent $field_component;

    public function __construct(
        public string $control_type = 'input',
        public array $input_fields = [],
        public array $textarea_fields = [],
        public array $native_select_fields = [],
        public array $checkbox_fields = [],
        public array $switch_toggle_fields = [],
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->field_component = match ($this->control_type) {
            'textarea' => new TextareaField(
                label:       $this->textarea_fields['label'] ?? '',
                label_for:   $this->textarea_fields['label_for'] ?? '',
                description: $this->textarea_fields['description'] ?? '',
                required:    (bool) ($this->textarea_fields['required'] ?? false),
                error:       $this->textarea_fields['error'] ?? '',
                name:        $this->textarea_fields['name'] ?? '',
                placeholder: $this->textarea_fields['placeholder'] ?? '',
                rows:        (int) ($this->textarea_fields['rows'] ?? 4),
                disabled:    (bool) ($this->textarea_fields['disabled'] ?? false),
                readonly:    (bool) ($this->textarea_fields['readonly'] ?? false),
            ),
            'native-select' => new NativeSelectField(
                label:       $this->native_select_fields['label'] ?? '',
                label_for:   $this->native_select_fields['label_for'] ?? '',
                description: $this->native_select_fields['description'] ?? '',
                required:    (bool) ($this->native_select_fields['required'] ?? false),
                error:       $this->native_select_fields['error'] ?? '',
                name:        $this->native_select_fields['name'] ?? '',
                placeholder: $this->native_select_fields['placeholder'] ?? '',
                items:       $this->native_select_fields['items'] ?? [],
                disabled:    (bool) ($this->native_select_fields['disabled'] ?? false),
            ),
            'checkbox' => new CheckboxField(
                label:       $this->checkbox_fields['label'] ?? '',
                description: $this->checkbox_fields['description'] ?? '',
                required:    (bool) ($this->checkbox_fields['required'] ?? false),
                error:       $this->checkbox_fields['error'] ?? '',
                name:        $this->checkbox_fields['name'] ?? '',
                value:       $this->checkbox_fields['value'] ?? '1',
                checked:     (bool) ($this->checkbox_fields['checked'] ?? false),
            ),
            'switch-toggle' => new CheckboxField(
                variant:     'switch-toggle',
                label:       $this->switch_toggle_fields['label'] ?? '',
                description: $this->switch_toggle_fields['description'] ?? '',
                required:    (bool) ($this->switch_toggle_fields['required'] ?? false),
                error:       $this->switch_toggle_fields['error'] ?? '',
                name:        $this->switch_toggle_fields['name'] ?? '',
                checked:     (bool) ($this->switch_toggle_fields['checked'] ?? false),
            ),
            default => new InputField(
                label:       $this->input_fields['label'] ?? '',
                label_for:   $this->input_fields['label_for'] ?? '',
                description: $this->input_fields['description'] ?? '',
                required:    (bool) ($this->input_fields['required'] ?? false),
                error:       $this->input_fields['error'] ?? '',
                field_type:  $this->input_fields['field_type'] ?? 'text',
                name:        $this->input_fields['name'] ?? '',
                placeholder: $this->input_fields['placeholder'] ?? '',
            ),
        };
    }

}
