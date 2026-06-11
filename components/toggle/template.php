<?php
/** @var \Theme\Components\Toggle $this */
?>
<div <?= $this->component_attrs() ?>
     data-pressed="<?= esc_attr($this->pressed ? 'true' : 'false') ?>"
     data-disabled="<?= esc_attr($this->disabled ? 'true' : 'false') ?>">
    <button data-slot="toggle"
            type="button"
            x-data="<?= esc_attr($this->component_module_name()) ?>()"
            :aria-pressed="pressed.toString()"
            :data-state="pressed ? 'on' : 'off'"
            @click="toggle()"
            :disabled="disabled || null"
            class="<?= esc_attr($this->toggle_classes()) ?>">
        <?= esc_html($this->label) ?>
    </button>
</div>
