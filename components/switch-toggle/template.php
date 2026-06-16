<?php

/** @var \Theme\Components\SwitchToggle $this */
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?>">
    <span data-slot="switch-root"
        x-data="<?= esc_attr($this->component_module_name()) ?>()"
        data-checked="<?= esc_attr($this->checked ? 'true' : 'false') ?>"
        data-name="<?= esc_attr($this->name) ?>"
        data-disabled="<?= esc_attr($this->disabled ? 'true' : 'false') ?>"
        class="inline-flex items-center gap-2">

        <button role="switch"
            type="button"
            data-slot="switch-toggle"
            :aria-checked="checked.toString()"
            :aria-labelledby="$id('label')"
            :data-state="checked ? 'checked' : 'unchecked'"
            @click="!disabled && (checked = !checked)"
            :disabled="disabled || null"
            class="inline-flex items-center rounded-full w-11 h-6 p-0.5 transition-colors duration-150 bg-input data-[state=checked]:bg-primary group focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50">
            <span data-slot="switch-thumb"
                class="block rounded-full bg-white w-5 h-5 transition-transform duration-150 translate-x-0 pointer-events-none group-data-[state=checked]:translate-x-5"></span>
        </button>

        <input type="hidden" :name="name" :value="checked ? '1' : ''">

        <span data-slot="switch-label"
            :id="$id('label')"
            @click="!disabled && (checked = !checked)"
            class="text-sm font-medium leading-none cursor-pointer">
            <?= esc_html($this->label) ?>
            <?php if ($this->required): ?>
                <span data-slot="label-required" aria-hidden="true" class="text-destructive"> *</span>
            <?php endif; ?>
        </span>

    </span>
</div>
