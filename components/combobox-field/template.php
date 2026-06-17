<?php

/** @var \Theme\Components\Combobox $this */
?>
<div <?= $this->component_attrs() ?> class="<?= classNames($this->component_classes(), 'flex flex-col gap-1.5') ?>">
    <?php if ($this->label_component): ?>
        <?= $this->label_component ?>
    <?php endif; ?>

    <div data-slot="combobox"
        class="relative"
        x-data="<?= esc_attr($this->component_module_name()) ?>()"
        @click.outside="open = false; query = selected ? selected.label : ''"
        data-name="<?= esc_attr($this->name) ?>"
        data-placeholder="<?= esc_attr($this->placeholder) ?>"
        data-options="<?= esc_attr($this->options_json()) ?>">

        <div data-slot="combobox-trigger-wrapper" class="relative flex items-center">

            <input data-slot="combobox-input"
                type="text"
                id="<?= esc_attr($this->id) ?>"
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
                class="flex h-9 w-full rounded-md border border-input px-3 py-1 pr-8 text-base shadow-xs outline-none placeholder:text-muted-foreground focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring md:text-sm">

            <button data-slot="combobox-chevron"
                type="button"
                @click="open = !open"
                aria-hidden="true"
                tabindex="-1"
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
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </button>

        </div>

        <input type="hidden" :name="name" :value="selected ? selected.value : ''">

        <div data-slot="combobox-content"
            role="listbox"
            id="combobox-listbox-<?= esc_attr($this->name ?: 'default') ?>"
            aria-label="<?= esc_attr($this->placeholder) ?>"
            x-show="open"
            x-cloak
            class="absolute top-[calc(100%+0.25rem)] left-0 z-50 w-full rounded-[calc(var(--radius)-2px)] border border-border bg-background p-1 shadow-md max-h-60 overflow-y-auto">

            <template x-for="(option, index) in filteredOptions" :key="option.value">
                <div data-slot="combobox-item"
                    role="option"
                    :aria-selected="selected && selected.value === option.value"
                    :data-active="activeIndex === index"
                    @click="choose(option)"
                    class="flex items-center gap-2 px-2 py-1.5 text-sm rounded-sm cursor-pointer hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground">
                    <span data-slot="combobox-item-indicator"
                        x-show="selected && selected.value === option.value"
                        aria-hidden="true"
                        class="w-4 text-center text-primary">
                        &#x2713;
                    </span>
                    <span x-text="option.label"></span>
                </div>
            </template>

            <div data-slot="combobox-empty"
                x-show="filteredOptions.length === 0"
                class="px-2 py-4 text-center text-sm text-muted-foreground">
                No results.
            </div>

        </div>
    </div>

    <?php if ($this->description): ?>
        <p data-slot="field-description">
            <?= esc_html($this->description) ?>
        </p>
    <?php endif; ?>

    <?php if ($this->has_error()): ?>
        <p data-slot="field-error"
            <?php if ($this->error_id()): ?>id="<?= esc_attr($this->error_id()) ?>" <?php endif; ?>
            role="alert">
            <?= esc_html($this->error) ?>
        </p>
    <?php endif; ?>
</div>
