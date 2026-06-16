<?php

/** @var \Theme\Components\HoverCard $this */
?>
<div <?= $this->component_attrs() ?>
    class="<?= classNames(
                $this->component_classes(),
                'relative inline-block',
            ) ?>"
    x-data="<?= esc_attr($this->component_module_name()) ?>()">

    <?php if ($this->trigger_url): ?>
        <a href="<?= esc_url($this->trigger_url) ?>"
            class="underline-offset-4 hover:underline focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
            <?= esc_html($this->trigger_label) ?>
        </a>
    <?php else: ?>
        <span tabindex="0"
            class="cursor-default underline-offset-4 decoration-dotted hover:underline focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
            <?= esc_html($this->trigger_label) ?>
        </span>
    <?php endif; ?>
</div>
