<?php
/** @var \Theme\Components\Table $this */
?>
<div <?= $this->component_attrs() ?>>
    <div class="w-full overflow-x-auto">
        <table data-slot="table" class="w-full caption-bottom text-sm">

            <?php if ($this->caption): ?>
                <caption data-slot="table-caption" class="mt-4 text-sm text-muted-foreground">
                    <?= esc_html($this->caption) ?>
                </caption>
            <?php endif; ?>

            <?php if (! empty($this->headers)): ?>
                <thead data-slot="table-header">
                    <tr data-slot="table-row">
                        <?php foreach ($this->headers as $header): ?>
                            <th data-slot="table-head"
                                scope="col"
                                class="h-10 px-4 text-left align-middle font-medium whitespace-nowrap">
                                <?= esc_html($header['label'] ?? '') ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
            <?php endif; ?>

            <?php if (! empty($this->rows)): ?>
                <tbody data-slot="table-body">
                    <?php foreach ($this->rows as $row): ?>
                        <tr data-slot="table-row">
                            <?php foreach (($row['cells'] ?? []) as $cell): ?>
                                <td data-slot="table-cell"
                                    class="p-4 align-middle whitespace-nowrap">
                                    <?= esc_html($cell['content'] ?? '') ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php endif; ?>

        </table>
    </div>
</div>
