<?php
/** @var \Theme\Components\DataTable $this */
?>
<div <?= $this->component_attrs() ?>
     x-data="<?= esc_attr($this->component_module_name()) ?>()"
     data-config="<?= esc_attr($this->get_config()) ?>"
     data-filterable="<?= esc_attr($this->filterable ? 'true' : 'false') ?>">

    <?php if ($this->filterable): ?>
        <div data-slot="data-table-filter" class="flex items-center py-4">
            <input type="text"
                   aria-label="Filter table rows"
                   data-slot="data-table-filter-input"
                   x-model="search"
                   placeholder="Filter..."
                   class="flex h-9 w-full max-w-sm rounded-md border px-3 py-1 text-sm shadow-sm transition-colors">
        </div>
    <?php endif; ?>

    <div data-slot="data-table-wrapper" class="w-full overflow-x-auto rounded-md border">
        <table data-slot="table" class="w-full caption-bottom text-sm">

            <?php if ($this->caption): ?>
                <caption data-slot="table-caption" class="mt-4 text-sm text-muted-foreground">
                    <?= esc_html($this->caption) ?>
                </caption>
            <?php endif; ?>

            <thead data-slot="table-header">
                <tr data-slot="table-row" class="border-b">
                    <template x-for="header in headers" :key="header.key">
                        <th data-slot="table-head"
                            @click="header.sortable ? sort(header.key) : null"
                            @keydown.enter.prevent="header.sortable ? sort(header.key) : null"
                            @keydown.space.prevent="header.sortable ? sort(header.key) : null"
                            :tabindex="header.sortable ? 0 : null"
                            :data-sortable="header.sortable"
                            :aria-sort="getSortAttr(header.key)"
                            :class="header.sortable ? 'cursor-pointer select-none' : ''"
                            class="h-10 px-4 text-left align-middle font-medium text-muted-foreground whitespace-nowrap">
                            <span class="inline-flex items-center gap-1">
                                <span x-text="header.label"></span>
                                <span data-slot="sort-icon" x-show="header.sortable" aria-hidden="true">
                                    <svg x-show="sortKey !== header.key" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7 15 5 5 5-5"/><path d="m7 9 5-5 5 5"/></svg>
                                    <svg x-show="sortKey === header.key && sortDir === 'asc'" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
                                    <svg x-show="sortKey === header.key && sortDir === 'desc'" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                </span>
                            </span>
                        </th>
                    </template>
                </tr>
            </thead>

            <tbody data-slot="table-body">
                <template x-for="(row, rowIndex) in filteredSortedRows" :key="rowIndex">
                    <tr data-slot="table-row" class="border-b last:border-0 transition-colors hover:bg-muted/50">
                        <template x-for="(cell, cellIndex) in row" :key="cellIndex">
                            <td data-slot="table-cell"
                                x-text="cell.content"
                                class="p-4 align-middle">
                            </td>
                        </template>
                    </tr>
                </template>

                <tr x-show="filteredSortedRows.length === 0" data-slot="table-row">
                    <td :colspan="Math.max(headers.length, 1)"
                        data-slot="table-cell"
                        class="p-4 text-center text-muted-foreground text-sm">
                        No results found.
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

</div>
