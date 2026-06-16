<?php

/** @var \Theme\Components\DatePicker $this */
?>
<div <?= $this->component_attrs() ?>
    x-data="<?= esc_attr($this->component_module_name()) ?>()"
    class="<?= classNames($this->component_classes(), 'relative flex flex-col gap-1.5') ?>">

    <?php if ($this->label_component): ?>
        <?= $this->label_component ?>
    <?php endif; ?>

    <button type="button"
        data-slot="date-picker-trigger"
        <?php if ($this->trigger_id()): ?>id="<?= esc_attr($this->trigger_id()) ?>" <?php endif; ?>
        x-ref="trigger"
        @click="open = !open"
        :aria-expanded="open.toString()"
        class="inline-flex items-center gap-2 w-full min-w-60 h-9 rounded-md border border-input bg-background cursor-pointer transition-colors duration-150 px-3 py-2 text-sm text-left hover:border-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="shrink-0 opacity-60">
            <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
            <line x1="16" x2="16" y1="2" y2="6" />
            <line x1="8" x2="8" y1="2" y2="6" />
            <line x1="3" x2="21" y1="10" y2="10" />
        </svg>
        <span x-text="formattedDate || placeholder" :class="formattedDate ? '' : 'text-muted-foreground'"></span>
    </button>

    <input type="hidden" :name="name" :value="selectedDate">

    <div data-slot="date-picker-content"
        x-show="open"
        @click.outside="open = false"
        @keydown.escape.window="if (open) { open = false; $refs.trigger.focus() }"
        x-cloak
        class="absolute z-50 mt-1 rounded-md border bg-popover text-popover-foreground shadow-md w-60">

        <div data-slot="calendar-nav" class="flex items-center justify-between p-3 pb-0">
            <button type="button"
                data-slot="calendar-prev"
                @click="prevMonth()"
                aria-label="Previous month"
                class="inline-flex items-center justify-center size-7 rounded-md hover:bg-accent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>

            <span data-slot="calendar-month-label" class="text-sm font-medium" aria-live="polite" x-text="monthLabel"></span>

            <button type="button"
                data-slot="calendar-next"
                @click="nextMonth()"
                aria-label="Next month"
                class="inline-flex items-center justify-center size-7 rounded-md hover:bg-accent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
        </div>

        <div data-slot="calendar-weekdays" class="grid grid-cols-7 px-3 pt-2">
            <?php foreach (['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'] as $day): ?>
                <div class="flex items-center justify-center h-8 text-xs text-muted-foreground font-medium">
                    <?= esc_html($day) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div data-slot="calendar-grid" class="grid grid-cols-7 p-3 pt-0">
            <template x-for="day in days" :key="day.fullDate">
                <button type="button"
                    data-slot="calendar-day"
                    @click="selectDay(day)"
                    :data-selected="isSelected(day)"
                    :data-today="isToday(day)"
                    :data-outside="day.outside"
                    :disabled="isDisabled(day) || null"
                    :aria-label="day.fullDate"
                    x-text="day.date"
                    :class="{
                        'bg-accent font-semibold': isToday(day) && !isSelected(day),
                        'bg-primary text-primary-foreground font-semibold': isSelected(day),
                        'opacity-40': day.outside,
                        'hover:bg-accent': !isSelected(day)
                    }"
                    class="flex items-center justify-center h-8 w-full text-sm rounded-md cursor-pointer transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50">
                </button>
            </template>
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
