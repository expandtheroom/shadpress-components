<?php

/** @var \Theme\Components\Toggle $this */
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?>"
    x-data="<?= $this->component_module_name() ?>">

    <?php if ($this->name): ?>
        <template x-if="checked">
            <input type="hidden"
                name="<?= esc_attr($this->name) ?>"
                value="<?= esc_attr($this->value) ?>">
        </template>
    <?php endif; ?>

    <?= $this->button_component ?>
</div>