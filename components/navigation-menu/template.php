<?php
/** @var \Theme\Components\NavigationMenu $this */
$menu_html = $this->render_menu();
if ( ! $menu_html ) return;
?>
<div <?= $this->component_attrs() ?>>
    <nav data-slot="navigation-menu"
         data-orientation="<?= esc_attr($this->orientation) ?>"
         aria-label="<?= esc_attr($this->menu_name()) ?>">
        <?= $menu_html ?>
    </nav>
</div>
