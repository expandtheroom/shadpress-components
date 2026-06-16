<?php

/** @var \Theme\Components\Label $this */
?>
<label <?= $this->component_attrs() ?>
    class="<?= classNames($this->component_classes(), 'text-sm font-medium leading-none text-foreground peer-disabled:cursor-not-allowed peer-disabled:opacity-70') ?>">
    <?= esc_html($this->text) ?>
    <?php if ($this->required): ?>
        <span data-slot="label-required" aria-hidden="true" class="text-destructive"> *</span>
    <?php endif; ?>
</label>
