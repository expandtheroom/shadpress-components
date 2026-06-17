<?php

/** @var \Theme\Components\CheckboxGroupField $this */
?>
<div <?= $this->component_attrs() ?> class="flex flex-col gap-1.5">
    <?php if ($this->label_component): ?>
        <?= $this->label_component ?>
    <?php endif; ?>

    <div class="<?= classNames('flex gap-2', [
                    'flex-col items-start' => $this->orientation === 'vertical',
                    'flex-row items-center' => $this->orientation === 'horizontal',
                ]) ?>"
        role="group"
        data-slot="checkbox-group"
        <?php if ($this->label_component): ?>aria-labelledby="<?= esc_attr($this->id) ?>-label" <?php endif; ?>>
        <?php foreach ($this->checkbox_components as $checkbox): ?>
            <?= $checkbox ?>
        <?php endforeach; ?>
    </div>

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
