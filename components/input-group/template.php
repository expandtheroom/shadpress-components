<?php
/** @var \Theme\Components\InputGroup $this */
?>
<div <?= $this->component_attrs() ?>
     class="flex items-stretch h-9 w-full rounded-md border text-base shadow-xs transition-[color,box-shadow] focus-within:ring-[3px] focus-within:ring-ring/50 focus-within:border-ring">

    <?php if ($this->prefix): ?>
        <span data-slot="input-group-addon"
              class="flex items-center px-3 text-sm">
            <?= esc_html($this->prefix) ?>
        </span>
    <?php endif; ?>

    <?= $this->input ?>

    <?php if ($this->suffix): ?>
        <span data-slot="input-group-addon"
              class="flex items-center px-3 text-sm">
            <?= esc_html($this->suffix) ?>
        </span>
    <?php endif; ?>

</div>
