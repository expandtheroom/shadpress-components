<?php
/** @var \Theme\Components\Select $this */
?>
<div <?= $this->component_attrs() ?>>
    <div data-slot="select"
         class="relative"
         x-data="<?= esc_attr($this->component_module_name()) ?>()"
         data-placeholder="<?= esc_attr($this->placeholder) ?>"
         data-name="<?= esc_attr($this->name) ?>"
         data-disabled="<?= esc_attr($this->disabled ? 'true' : 'false') ?>"
         @keydown.arrow-down.prevent="!disabled && openAndMoveNext()"
         @keydown.arrow-up.prevent="!disabled && openAndMovePrev()"
         @keydown.enter.prevent="!disabled && confirmActive()"
         @keydown.escape="!disabled && (open = false)">

        <button data-slot="select-trigger"
                type="button"
                x-ref="trigger"
                :aria-expanded="open.toString()"
                @click="!disabled && (open = !open)"
                :disabled="disabled || null"
                class="flex h-9 w-full items-center justify-between rounded-md border px-3 py-2 text-sm shadow-xs outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring disabled:cursor-not-allowed disabled:opacity-50">
            <span data-slot="select-value"
                  x-text="selected ? selected.label : placeholder"></span>
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="16" height="16"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 :class="open ? 'rotate-180' : ''"
                 class="transition-transform shrink-0"
                 aria-hidden="true">
                <path d="m6 9 6 6 6-6"/>
            </svg>
        </button>

        <input type="hidden" :name="name" :value="selected ? selected.value : ''">

        <div data-slot="select-content"
             role="listbox"
             aria-label="<?= esc_attr($this->placeholder) ?>"
             x-show="open"
             @click.outside="open = false"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             x-cloak>

            <?php foreach ($this->options as $index => $item): ?>
                <?php
                $val   = $item['value'] ?? '';
                $label = $item['label'] ?? '';
                ?>
                <div data-slot="select-item"
                     role="option"
                     data-value="<?= esc_attr($val) ?>"
                     data-label="<?= esc_attr($label) ?>"
                     :aria-selected="selected && selected.value === '<?= esc_attr($val) ?>'"
                     :data-active="activeIndex === <?= (int) $index ?>"
                     @click="choose('<?= esc_attr($val) ?>', '<?= esc_attr($label) ?>')">
                    <span data-slot="select-item-indicator"
                          x-show="selected && selected.value === '<?= esc_attr($val) ?>'"
                          aria-hidden="true">
                        &#x2713;
                    </span>
                    <?= esc_html($label) ?>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
