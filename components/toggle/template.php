<?php

/** @var \Theme\Components\Toggle $this */
?>
<div <?= $this->component_attrs() ?>
    class="<?= $this->component_classes() ?>"
    x-data="<?= esc_attr($this->component_module_name()) ?>()">

    <?php if ($this->name): ?>
        <template x-if="checked">
            <input type="hidden"
                name="<?= esc_attr($this->name) ?>"
                value="<?= esc_attr($this->value) ?>">
        </template>
    <?php endif; ?>

    <button data-slot="toggle"
        type="button"
        <?php if ($this->required): ?>aria-required="true" <?php endif; ?>
        :aria-pressed="checked.toString()"
        :data-state="checked ? 'on' : 'off'"
        @click="toggle()"
        :disabled="disabled || null"
        class="<?= esc_attr($this->toggle_classes()) ?> data-[state=on]:bg-accent data-[state=on]:text-accent-foreground data-[state=on]:hover:bg-accent">
        <?= esc_html($this->label) ?>
    </button>
</div>
