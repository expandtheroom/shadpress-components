<?php

/** @var \Theme\Components\Badge $this */

$icon_html  = !empty($this->include_icon) ? $this->render_icon() : '';
$icon_left  = $this->icon_position !== 'right' ? $icon_html : '';
$icon_right = $this->icon_position === 'right' ? $icon_html : '';
?>
<span <?= $this->component_attrs() ?>
    class="<?= esc_attr(
                classNames(
                    $this->badge_classes(),
                    $this->component_classes(),
                )
            ) ?>">
    <?= $icon_left ?><?= esc_html($this->label) ?><?= $icon_right ?>
</span>
