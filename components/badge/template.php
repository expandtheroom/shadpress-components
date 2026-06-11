<?php
/** @var \Theme\Components\Badge $this */
?>
<span <?= $this->component_attrs() ?>
      class="<?= esc_attr(classNames($this->badge_classes(), $this->get_classes())) ?>">
    <?= esc_html($this->label) ?>
</span>
