<?php

/** @var \Theme\Components\LucideIcons $this */
?>
<div <?= $this->component_attrs() ?> class="<?= classNames($this->component_classes()) ?>">
    <div data-slot="icon">
        <?= $this->get_svg() ?>
    </div>
</div>
