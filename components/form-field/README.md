# Form Field

Unified form field block wrapper supporting multiple control types in the Gutenberg editor.

## Control Types

| `control_type` | Delegates to | Fields group prop |
|----------------|--------------|-------------------|
| `'input'` | `InputField` | `input_fields` |
| `'textarea'` | `TextareaField` | `textarea_fields` |
| `'select'` | `SelectField` | `select_fields` |
| `'checkbox'` | `CheckboxField` | `checkbox_fields` |
| `'checkbox-group'` | `CheckboxGroupField` | `checkbox_group_fields` |
| `'combobox'` | `ComboboxField` | `combobox_fields` |
| `'date-picker'` | `DatePickerField` | `date_picker_fields` |
| `'radio-group'` | `RadioGroupField` | `radio_group_fields` |
| `'styled-select'` | `StyledSelectField` | `styled_select_fields` |
| `'switch-toggle'` | `CheckboxField(component: 'switch-toggle')` | `checkbox_fields` |
| `'toggle'` | `CheckboxField(component: 'toggle')` | `checkbox_fields` |
| `'toggle-group'` | `CheckboxGroupField(variant: 'toggle-group')` | `checkbox_group_fields` |

## Usage

FormField is a block wrapper component that allows the various field components to be deployed via the Gutenberg editor. While it is possible to use FormField to programmatically a simpler and cleaner approach for programmatic use is to use the field components directly.

- CheckboxField (checkbox-field)
- CheckboxGroupField (checkbox-group-field)
- ComboboxField (combobox-field)
- DatePickerField (date-pickdr-field)
- InputField (input-field)
- RadioGropuField (radio-group-field)
- SelectField (select-field)
- StyledSelectField (styled-select-field)
- TextareaField (textarea-field)

## ACF Fields

FormField uses field definitions form the selected subfield, and as such, the fields that it does define are not really meant for import and composition by other components.

If you need to import specific field definitions, get them from the specific field you'll be dealing with.
