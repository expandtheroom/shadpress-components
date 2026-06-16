<?php

/** @var \Theme\Components\InputField $this */
?>
<div <?= $this->component_attrs() ?> class="<?= classNames($this->component_classes(), 'flex flex-col gap-1.5') ?>">
    <?= $this->label_component ?>

    <?php if ($this->has_addons()): ?>
        <div data-slot="input-group"
            class="flex items-stretch h-9 w-full rounded-md border border-input text-base shadow-xs transition-[color,box-shadow] focus-within:ring-[3px] focus-within:ring-ring/50 focus-within:border-ring">

            <?php if ($this->prefix): ?>
                <span data-slot="input-group-addon"
                    class="flex items-center px-3 text-sm bg-muted text-muted-foreground border-r border-border last:border-r-0 last:border-l last:border-border">
                    <?= esc_html($this->prefix) ?>
                </span>
            <?php endif; ?>

            <?= $this->control_component ?>

            <?php if ($this->suffix): ?>
                <span data-slot="input-group-addon"
                    class="flex items-center px-3 text-sm bg-muted text-muted-foreground border-r border-border last:border-r-0 last:border-l last:border-border">
                    <?= esc_html($this->suffix) ?>
                </span>
            <?php endif; ?>

        </div>
    <?php else: ?>
        <?= $this->control_component ?>
    <?php endif; ?>

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
