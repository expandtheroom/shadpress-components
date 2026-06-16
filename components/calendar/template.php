<?php

/** @var \Theme\Components\Calendar $this */
?>
<div <?= $this->component_attrs() ?>
    x-data="<?= esc_attr($this->component_module_name()) ?>">

    <input type="hidden" :name="name" :value="selectedDate">

    <div data-slot="calendar" class="p-3">

        <div data-slot="calendar-nav" class="flex items-center justify-between mb-4">
            <button type="button"
                data-slot="calendar-prev"
                @click="prevMonth()"
                aria-label="Previous month"
                class="inline-flex items-center justify-center size-7 rounded-md hover:bg-accent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>

            <span data-slot="calendar-month-label" class="text-sm font-medium" aria-live="polite" x-text="monthLabel"><?= esc_html($this->month_label()) ?></span>

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

        <div data-slot="calendar-weekdays" class="grid grid-cols-7 mb-1">
            <?php foreach ($this->day_names() as $day): ?>
                <div class="flex items-center justify-center h-8 text-xs text-muted-foreground font-medium">
                    <?= esc_html($day) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div data-slot="calendar-grid" class="grid grid-cols-7">
            <?php foreach ($this->build_days() as $day): ?>
                <button type="button"
                    data-slot="calendar-day"
                    data-day="<?= esc_attr(wp_json_encode($day)) ?>"
                    <?= $this->is_today($day['fullDate'])    ? 'data-today="true"'    : '' ?>
                    <?= $this->is_selected($day['fullDate']) ? 'data-selected="true"' : '' ?>
                    <?= $day['outside']                      ? 'data-outside="true"'  : '' ?>
                    <?= $this->is_disabled($day['fullDate']) ? 'disabled'             : '' ?>
                    aria-label="<?= esc_attr($day['fullDate']) ?>"
                    class="flex items-center justify-center h-8 w-full text-sm rounded-md cursor-pointer transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring enabled:hover:bg-accent data-[today=true]:bg-accent data-[today=true]:font-semibold data-[selected=true]:bg-primary data-[selected=true]:text-primary-foreground data-[selected=true]:font-semibold data-[selected=true]:hover:bg-primary data-[outside=true]:opacity-40 disabled:cursor-not-allowed disabled:pointer-events-none disabled:opacity-50">
                    <?= esc_html($day['date']) ?>
                </button>
            <?php endforeach; ?>
        </div>

    </div>
</div>
