<?php

/** @var \Theme\Components\Select $this */
?>
<select <?= $this->component_attrs() ?>
    class="<?= classNames(
                $this->component_classes(),
                'flex h-9 w-full rounded-md border px-3 py-1 text-base shadow-xs border-input bg-background',
                'transition-[color,box-shadow] outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 focus-visible:border-ring',
                'aria-invalid:ring-destructive/20 aria-invalid:border-destructive disabled:cursor-not-allowed disabled:opacity-50 md:text-sm'
            ) ?>">

    <?php if ($this->placeholder): ?>
        <option value=""
            disabled
            selected
            hidden>
            <?= esc_html($this->placeholder) ?>
        </option>
    <?php endif; ?>

    <?php foreach ($this->options as $item):
        if (empty($item['value'])) continue;
    ?>
        <option value="<?= esc_attr($item['value'] ?? '') ?>">
            <?= esc_html($item['label'] ?? $item['value']) ?>
        </option>
    <?php endforeach; ?>
</select>
