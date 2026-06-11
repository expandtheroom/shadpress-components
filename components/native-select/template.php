<?php
/** @var \Theme\Components\NativeSelect $this */
?>
<select <?= $this->component_attrs() ?>
        class="<?= esc_attr($this->select_classes()) ?>">

    <?php if ($this->placeholder): ?>
        <option value=""
                disabled
                selected
                hidden>
            <?= esc_html($this->placeholder) ?>
        </option>
    <?php endif; ?>

    <?php foreach ($this->options as $item): ?>
        <option value="<?= esc_attr($item['value'] ?? '') ?>">
            <?= esc_html($item['label'] ?? '') ?>
        </option>
    <?php endforeach; ?>

</select>
