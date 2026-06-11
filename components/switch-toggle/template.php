<?php
/** @var \Theme\Components\SwitchToggle $this */
?>
<div <?= $this->component_attrs() ?>>
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
                :data-state="checked ? 'checked' : 'unchecked'"
                @click="!disabled && (checked = !checked)"
                :disabled="disabled || null"
                class="focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50">
            <span data-slot="switch-thumb"></span>
        </button>

        <input type="hidden" :name="name" :value="checked ? '1' : ''">

        <label data-slot="switch-label"
               @click="!disabled && (checked = !checked)"
               class="text-sm font-medium leading-none cursor-pointer">
            <?= esc_html($this->label) ?>
            <?php if ($this->required): ?>
                <span data-slot="label-required" aria-hidden="true" class="text-destructive"> *</span>
            <?php endif; ?>
        </label>

    </span>
</div>
