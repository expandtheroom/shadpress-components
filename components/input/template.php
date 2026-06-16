<?php

/** @var \Theme\Components\Input $this */
?>
<input <?= $this->component_attrs() ?>
    class="<?= classNames(
                $this->component_classes(),
                'file:text-foreground placeholder:text-muted-foreground',
                'selection:bg-primary selection:text-primary-foreground',
                'focus-visible:border-ring focus-visible:ring-ring/50',
                'aria-invalid:ring-destructive/20 aria-invalid:border-destructive',
                'flex h-9 w-full min-w-0 rounded-md border border-input bg-transparent',
                'px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none',
                'focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50'
            ) ?>">
