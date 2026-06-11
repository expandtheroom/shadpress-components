<?php
/** @var \Theme\Components\ToggleGroup $this */
$type = in_array($this->type, ['single', 'multiple'], true) ? $this->type : 'single';
?>
<div <?= $this->component_attrs() ?>>
    <div data-slot="toggle-group"
         role="group"
         <?php if ($this->label): ?>aria-label="<?= esc_attr($this->label) ?>"<?php endif; ?>
         x-data="<?= esc_attr($this->component_module_name()) ?>()"
         data-type="<?= esc_attr($type) ?>"
         data-default="<?= esc_attr($this->default_value) ?>">

        <?php foreach ($this->toggles as $item): ?>
            <?php $val = $item['value'] ?? ''; ?>
            <button data-slot="toggle-group-item"
                    type="button"
                    data-value="<?= esc_attr($val) ?>"
                    :aria-pressed="type === 'single' ? (value === '<?= esc_attr($val) ?>').toString() : values.includes('<?= esc_attr($val) ?>').toString()"
                    :data-state="(type === 'single' ? value === '<?= esc_attr($val) ?>' : values.includes('<?= esc_attr($val) ?>')) ? 'on' : 'off'"
                    @click="toggle('<?= esc_attr($val) ?>')">
                <?= esc_html($item['label'] ?? '') ?>
            </button>
        <?php endforeach; ?>

    </div>
</div>
