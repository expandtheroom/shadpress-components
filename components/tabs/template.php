<?php
/** @var \Theme\Components\Tabs $this */
?>
<div <?= $this->component_attrs() ?>
     class="<?= esc_attr($this->get_classes()) ?>"
     x-data="<?= esc_attr($this->component_module_name()) ?>()">

    <div role="tablist"
         data-slot="tabs-list"
         class="bg-muted text-muted-foreground inline-flex h-9 w-fit items-center justify-center rounded-lg p-1">

        <?php foreach ($this->tabs as $index => $tab): ?>
            <button role="tab"
                    data-slot="tab-trigger"
                    type="button"
                    class="focus-visible:ring-ring inline-flex items-center justify-center whitespace-nowrap rounded-md px-3 py-1 text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                <?= esc_html($tab['label'] ?? '') ?>
            </button>
        <?php endforeach; ?>

    </div>

    <?php foreach ($this->tabs as $index => $tab): ?>
        <div role="tabpanel"
             data-slot="tab-panel"
             tabindex="0"
             class="focus-visible:ring-ring mt-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2">
            <?= $this->tab_contents[$index] ?? '' ?>
        </div>
    <?php endforeach; ?>

</div>
