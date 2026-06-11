<?php
/** @var \Theme\Components\Combobox $this */
?>
<div <?= $this->component_attrs() ?>>
    <div data-slot="combobox"
         class="relative"
         x-data="<?= esc_attr($this->component_module_name()) ?>()"
         data-name="<?= esc_attr($this->name) ?>"
         data-placeholder="<?= esc_attr($this->placeholder) ?>"
         data-options="<?= esc_attr($this->options_json()) ?>">

        <div data-slot="combobox-trigger-wrapper" class="relative flex items-center">

            <input data-slot="combobox-input"
                   type="text"
                   role="combobox"
                   :aria-expanded="open.toString()"
                   aria-autocomplete="list"
                   aria-controls="combobox-listbox-<?= esc_attr($this->name ?: 'default') ?>"
                   :value="selected ? selected.label : query"
                   @input="query = $event.target.value; open = true; selected = null; activeIndex = -1"
                   @focus="open = true"
                   @keydown.arrow-down.prevent="moveNext()"
                   @keydown.arrow-up.prevent="movePrev()"
                   @keydown.enter.prevent="selectActive()"
                   @keydown.escape="open = false; query = selected ? selected.label : ''"
                   :placeholder="placeholder"
                   class="flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-xs outline-none placeholder:text-muted-foreground focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring md:text-sm">

            <button data-slot="combobox-chevron"
                    type="button"
                    @click="open = !open"
                    aria-hidden="true"
                    class="absolute right-2 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="16" height="16"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     :class="open ? 'rotate-180' : ''"
                     class="transition-transform">
                    <path d="m6 9 6 6 6-6"/>
                </svg>
            </button>

        </div>

        <input type="hidden" :name="name" :value="selected ? selected.value : ''">

        <div data-slot="combobox-content"
             role="listbox"
             id="combobox-listbox-<?= esc_attr($this->name ?: 'default') ?>"
             aria-label="<?= esc_attr($this->placeholder) ?>"
             x-show="open"
             @click.outside="open = false; query = selected ? selected.label : ''"
             x-cloak>

            <template x-for="(option, index) in filteredOptions" :key="option.value">
                <div data-slot="combobox-item"
                     role="option"
                     :aria-selected="selected && selected.value === option.value"
                     :data-active="activeIndex === index"
                     @click="choose(option)">
                    <span data-slot="combobox-item-indicator"
                          x-show="selected && selected.value === option.value"
                          aria-hidden="true">
                        &#x2713;
                    </span>
                    <span x-text="option.label"></span>
                </div>
            </template>

            <div data-slot="combobox-empty"
                 x-show="filteredOptions.length === 0">
                No results.
            </div>

        </div>
    </div>
</div>
