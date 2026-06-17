<?php

/** @var \Theme\Components\StyledSelectField $this */
?>
<div <?= $this->component_attrs() ?> class="flex flex-col gap-1.5">
    <?php if ($this->label_component): ?>
        <?= $this->label_component ?>
    <?php endif; ?>

    <div <?= $this->component_attrs() ?>
        class="<?= classNames($this->component_classes(), 'relative') ?>"
        x-data="<?= esc_attr($this->component_module_name()) ?>()"
        @keydown.arrow-down.prevent="!disabled && openAndMoveNext()"
        @keydown.arrow-up.prevent="!disabled && openAndMovePrev()"
        @keydown.enter.prevent="!disabled && confirmActive()"
        @keydown.escape="!disabled && (open = false)">

        <button data-slot="select-trigger"
            type="button"
            id="<?= esc_attr($this->id) ?>"
            x-ref="trigger"
            :aria-expanded="open.toString()"
            @click="!disabled && (open = !open)"
            :disabled="disabled || null"
            class="flex h-9 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm shadow-xs outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring disabled:cursor-not-allowed disabled:opacity-50">
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
                <path d="m6 9 6 6 6-6" />
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
            x-cloak
            class="absolute top-[calc(100%+0.25rem)] left-0 z-50 w-full min-w-32 rounded-[calc(var(--radius)-2px)] border border-border bg-background p-1 shadow-md">

            <?php foreach ($this->options as $index => $item):
                if (empty($item['value'])) {
                    continue;
                }
                $val = $item['value'] ?? '';
                $label = $item['label'] ?? '';
            ?>
                <div data-slot="select-item"
                    role="option"
                    data-value="<?= esc_attr($val) ?>"
                    data-label="<?= esc_attr($label) ?>"
                    :aria-selected="selected && selected.value === '<?= esc_attr($val) ?>'"
                    :data-active="activeIndex === <?= (int) $index ?>"
                    @click="choose('<?= esc_attr($val) ?>', '<?= esc_attr($label) ?>')"
                    class="flex items-center gap-2 px-2 py-1.5 text-sm rounded-sm cursor-pointer hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground">
                    <span data-slot="select-item-indicator"
                        x-show="selected && selected.value === '<?= esc_attr($val) ?>'"
                        aria-hidden="true"
                        class="w-4 text-center text-primary">
                        &#x2713;
                    </span>
                    <?= esc_html($label) ?>
                </div>
            <?php endforeach; ?>

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
