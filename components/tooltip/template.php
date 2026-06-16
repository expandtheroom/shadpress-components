<?php

/** @var \Theme\Components\Tooltip $this */
?>
<span <?= $this->component_attrs() ?>
    class="<?= $this->component_classes() ?>"
    x-data="<?= esc_attr($this->component_module_name()) ?>">
    <span data-slot="tooltip-trigger"
        tabindex="0"
        class="cursor-default focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring rounded-sm">
        <?= esc_html($this->trigger_label) ?>
    </span>
</span>
