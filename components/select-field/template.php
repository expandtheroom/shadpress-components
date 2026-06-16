<?php

/** @var \Theme\Components\SelectField $this */
?>
<div <?= $this->component_attrs() ?> class="<?= classNames($this->component_classes(), 'flex flex-col gap-1.5') ?>">
    <?= $this->label_component ?>

    <?= $this->control_component ?>

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
