<?php
/** @var \Theme\Components\Checkbox $this */
?>
<span <?= $this->component_attrs() ?>
      x-data="<?= esc_attr($this->component_module_name()) ?>()"
      class="inline-flex items-center gap-2">

    <button role="checkbox"
            type="button"
            data-slot="checkbox"
            :aria-checked="checked.toString()"
            :data-state="checked ? 'checked' : 'unchecked'"
            @click="!disabled && (checked = !checked)"
            :disabled="disabled || null"
            class="size-4 shrink-0 rounded-sm border focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:cursor-not-allowed disabled:opacity-50">

        <svg x-show="checked"
             xmlns="http://www.w3.org/2000/svg"
             width="12"
             height="12"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="3"
             stroke-linecap="round"
             stroke-linejoin="round"
             aria-hidden="true">
            <polyline points="20 6 9 17 4 12" />
        </svg>

    </button>

    <input type="hidden"
           :name="name"
           :value="checked ? value : ''">

    <label data-slot="checkbox-label"
           @click="!disabled && (checked = !checked)"
           class="text-sm font-medium leading-none cursor-pointer">
        <?= esc_html($this->label) ?>
        <?php if ($this->required): ?>
            <span data-slot="label-required" aria-hidden="true" class="text-destructive"> *</span>
        <?php endif; ?>
    </label>

</span>
