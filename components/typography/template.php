<?php
/** @var \Theme\Components\Typography $this */
?>
<div <?= $this->component_attrs() ?>
     class="<?= $this->component_classes() ?>">
    <?= wp_kses_post($this->body) ?>
</div>
