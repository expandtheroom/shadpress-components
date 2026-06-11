<?php
/** @var \Theme\Components\Calendar $this */
?>
<div <?= $this->component_attrs() ?>
     x-data="<?= esc_attr($this->component_module_name()) ?>()"
     data-name="<?= esc_attr($this->name) ?>"
     data-selected-date="<?= esc_attr($this->selected_date) ?>"
     data-min-date="<?= esc_attr($this->min_date) ?>"
     data-max-date="<?= esc_attr($this->max_date) ?>">

    <input type="hidden" :name="name" :value="selectedDate">

    <div data-slot="calendar" class="p-3">

        <div data-slot="calendar-nav" class="flex items-center justify-between mb-4">
            <button type="button"
                    data-slot="calendar-prev"
                    @click="prevMonth()"
                    aria-label="Previous month"
                    class="inline-flex items-center justify-center size-7 rounded-md hover:bg-accent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
            </button>

            <span data-slot="calendar-month-label" class="text-sm font-medium" aria-live="polite" x-text="monthLabel"></span>

            <button type="button"
                    data-slot="calendar-next"
                    @click="nextMonth()"
                    aria-label="Next month"
                    class="inline-flex items-center justify-center size-7 rounded-md hover:bg-accent">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
            </button>
        </div>

        <div data-slot="calendar-weekdays" class="grid grid-cols-7 mb-1">
            <?php foreach (['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'] as $day): ?>
                <div class="flex items-center justify-center h-8 text-xs text-muted-foreground font-medium">
                    <?= esc_html($day) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div data-slot="calendar-grid" class="grid grid-cols-7">
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
                        class="flex items-center justify-center h-8 w-full text-sm rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50">
                </button>
            </template>
        </div>

    </div>
</div>
