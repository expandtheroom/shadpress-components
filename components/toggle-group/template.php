<?php

/** @var \Theme\Components\ToggleGroup $this */
$layout      = in_array($this->layout, ['conjoined', 'separate'], true) ? $this->layout : 'conjoined';
$is_vertical = $this->orientation === 'vertical';

if ($layout === 'separate') {
    $wrapper_classes = classNames('inline-flex gap-1', $is_vertical && 'flex-col');
} else {
    $wrapper_classes = classNames(
        'inline-flex rounded-md overflow-hidden border border-border',
        '[&>*:not(:first-child):not(:last-child)]:rounded-none',
        $is_vertical
            ? '[&>*:first-child]:rounded-b-none [&>*:last-child]:rounded-t-none'
            : '[&>*:first-child]:rounded-r-none [&>*:last-child]:rounded-l-none',
        $is_vertical && 'flex-col',
    );
}
?>
<div <?= $this->component_attrs() ?> class="<?= classNames($this->component_classes(), 'flex flex-col gap-1.5') ?>">
    <?php if ($this->label_component): ?>
        <?= $this->label_component ?>
    <?php endif; ?>

    <div data-slot="toggle-group"
        role="group"
        class="<?= $wrapper_classes ?>"
        data-multiple="<?= $this->multiple ? 'true' : 'false' ?>"
        <?php if ($this->label_component): ?>aria-labelledby="<?= esc_attr($this->id) ?>-label" <?php elseif ($this->label): ?>aria-label="<?= esc_attr($this->label) ?>" <?php endif; ?>
        x-data="<?= $this->component_module_name() ?>">

        <?php foreach ($this->toggle_components as $toggle): ?>
            <?= $toggle ?>
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