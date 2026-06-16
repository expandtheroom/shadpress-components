<?php
/** @var \Theme\Components\ButtonGroup $this */
?>
<div <?= $this->component_attrs() ?>
     class="<?= esc_attr(classNames($this->wrapper_classes(), $this->component_classes())) ?>">
    <?php foreach ($this->button_components as $button): ?>
        <?= $button ?>
    <?php endforeach; ?>
</div>
