<?php
/** @var \Theme\Components\CheckboxField $this */
?>
<div <?= $this->component_attrs() ?> class="flex flex-col gap-1.5">
    <?= $this->control_component ?>

    <?php if ($this->description): ?>
        <p data-slot="field-description">
            <?= esc_html($this->description) ?>
        </p>
    <?php endif; ?>

    <?php if ($this->has_error()): ?>
        <p data-slot="field-error" role="alert">
            <?= esc_html($this->error) ?>
        </p>
    <?php endif; ?>
</div>
