<?php

namespace Theme\Components;

class FormField extends BaseComponent {

    public BaseComponent $field_component;

    public function __construct(
        public string $control_type = 'input',
        public array $checkbox_fields = [],
        public array $checkbox_group_fields = [],
        public array $combobox_fields = [],
        public array $date_picker_fields = [],
        public array $input_fields = [],
        public array $radio_group_fields = [],
        public array $select_fields = [],
        public array $styled_select_fields = [],
        public array $textarea_fields = [],
        public array $toggle_group_fields = [],

        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->field_component = match ($this->control_type) {
            'checkbox' => new CheckboxField(
                label: $this->checkbox_fields['label'] ?? '',
                description: $this->checkbox_fields['description'] ?? '',
                required: (bool) ($this->checkbox_fields['required'] ?? false),
                error: $this->checkbox_fields['error'] ?? '',
                value: $this->checkbox_fields['value'] ?? '1',
                checked: (bool) ($this->checkbox_fields['checked'] ?? false),
                disabled: (bool) ($this->checkbox_fields['disabled'] ?? false),
            ),
            'checkbox-group' => new CheckboxGroupField(
                description: $this->checkbox_group_fields['description'] ?? '',
                error: $this->checkbox_group_fields['error'] ?? '',
                label: $this->checkbox_group_fields['label'] ?? '',
                options: $this->checkbox_group_fields['options'] ?? [],
                orientation: $this->checkbox_group_fields['orientation'] ?? 'vertical',
                required: (bool) ($this->checkbox_group_fields['required'] ?? false),
            ),
            'combobox' => new ComboboxField(
                placeholder: $this->combobox_fields['placeholder'] ?? 'Search...',
                options: $this->combobox_fields['options'] ?? [],
                label: $this->combobox_fields['label'] ?? '',
                description: $this->combobox_fields['description'] ?? '',
                required: (bool) ($this->combobox_fields['required'] ?? false),
                error: $this->combobox_fields['error'] ?? '',
            ),
            'date-picker' => new DatePickerField(
                label: $this->date_picker_fields['label'] ?? '',
                placeholder: $this->date_picker_fields['placeholder'] ?? 'Pick a date',
                selected_date: $this->date_picker_fields['selected_date'] ?? '',
                min_date: $this->date_picker_fields['min_date'] ?? '',
                max_date: $this->date_picker_fields['max_date'] ?? '',
                description: $this->date_picker_fields['description'] ?? '',
                required: (bool) ($this->date_picker_fields['required'] ?? false),
                error: $this->date_picker_fields['error'] ?? '',
            ),
            'radio-group' => new RadioGroupField(
                label: $this->radio_group_fields['label'] ?? '',
                options: $this->radio_group_fields['options'] ?? [],
                default_value: $this->radio_group_fields['default_value'] ?? '',
                disabled: (bool) ($this->radio_group_fields['disabled'] ?? false),
                orientation: $this->radio_group_fields['orientation'] ?? 'horizontal',
                description: $this->radio_group_fields['description'] ?? '',
                required: (bool) ($this->radio_group_fields['required'] ?? false),
                error: $this->radio_group_fields['error'] ?? '',
            ),
            'select' => new SelectField(
                placeholder: $this->select_fields['placeholder'] ?? 'Select an option',
                options: $this->select_fields['options'] ?? [],
                disabled: (bool) ($this->select_fields['disabled'] ?? false),
                label: $this->select_fields['label'] ?? '',
                description: $this->select_fields['description'] ?? '',
                required: (bool) ($this->select_fields['required'] ?? false),
                error: $this->select_fields['error'] ?? '',
            ),
            'styled-select' => new StyledSelectField(
                placeholder: $this->styled_select_fields['placeholder'] ?? 'Select an option',
                options: $this->styled_select_fields['options'] ?? [],
                disabled: (bool) ($this->styled_select_fields['disabled'] ?? false),
                label: $this->styled_select_fields['label'] ?? '',
                description: $this->styled_select_fields['description'] ?? '',
                required: (bool) ($this->styled_select_fields['required'] ?? false),
                error: $this->styled_select_fields['error'] ?? '',
            ),
            'switch-toggle' => new CheckboxField(
                component: 'switch-toggle',
                label: $this->checkbox_fields['label'] ?? '',
                description: $this->checkbox_fields['description'] ?? '',
                required: (bool) ($this->checkbox_fields['required'] ?? false),
                error: $this->checkbox_fields['error'] ?? '',
                value: $this->checkbox_fields['value'] ?? '1',
                checked: (bool) ($this->checkbox_fields['checked'] ?? false),
                disabled: (bool) ($this->checkbox_fields['disabled'] ?? false),
            ),
            'textarea' => new TextareaField(
                label: $this->textarea_fields['label'] ?? '',
                description: $this->textarea_fields['description'] ?? '',
                required: (bool) ($this->textarea_fields['required'] ?? false),
                error: $this->textarea_fields['error'] ?? '',
                placeholder: $this->textarea_fields['placeholder'] ?? '',
                rows: (int) ($this->textarea_fields['rows'] ?? 4),
                disabled: (bool) ($this->textarea_fields['disabled'] ?? false),
                readonly: (bool) ($this->textarea_fields['readonly'] ?? false),
            ),
            'toggle' => new CheckboxField(
                component: 'toggle',
                label: $this->checkbox_fields['label'] ?? '',
                description: $this->checkbox_fields['description'] ?? '',
                required: (bool) ($this->checkbox_fields['required'] ?? false),
                error: $this->checkbox_fields['error'] ?? '',
                value: $this->checkbox_fields['value'] ?? '1',
                checked: (bool) ($this->checkbox_fields['checked'] ?? false),
                disabled: (bool) ($this->checkbox_fields['disabled'] ?? false),
                size: $this->checkbox_fields['size'] ?? 'default',
                variant: $this->checkbox_fields['variant'] ?? 'default',
            ),
            'toggle-group' => new ToggleGroup(
                label: $this->toggle_group_fields['label'] ?? '',
                options: $this->toggle_group_fields['options'] ?? [],
                orientation: $this->toggle_group_fields['orientation'] ?? 'horizontal',
                variant: $this->toggle_group_fields['variant'] ?? 'default',
                size: $this->toggle_group_fields['size'] ?? 'default',
                description: $this->toggle_group_fields['description'] ?? '',
                error: $this->toggle_group_fields['error'] ?? '',
                required: (bool) ($this->toggle_group_fields['required'] ?? false),
            ),
            default => new InputField(
                label: $this->input_fields['label'] ?? '',
                description: $this->input_fields['description'] ?? '',
                required: (bool) ($this->input_fields['required'] ?? false),
                error: $this->input_fields['error'] ?? '',
                field_type: $this->input_fields['field_type'] ?? 'text',
                placeholder: $this->input_fields['placeholder'] ?? '',
                prefix: $this->input_fields['prefix'] ?? '',
                suffix: $this->input_fields['suffix'] ?? '',
                disabled: (bool) ($this->input_fields['disabled'] ?? false),
            ),
        };
    }
}
