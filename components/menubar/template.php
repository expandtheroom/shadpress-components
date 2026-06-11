<?php
/** @var \Theme\Components\Menubar $this */
?>
<div <?= $this->component_attrs() ?>>
    <div data-slot="menubar"
         role="menubar"
         <?php if ($this->label): ?>aria-label="<?= esc_attr($this->label) ?>"<?php endif; ?>
         x-data="<?= esc_attr($this->component_module_name()) ?>()"
         data-menu-count="<?= esc_attr((string) count($this->menus)) ?>"
         @keydown.escape="active = null"
         @keydown.arrow-left.prevent="active !== null && moveFocus(-1)"
         @keydown.arrow-right.prevent="active !== null && moveFocus(1)">

        <?php foreach ($this->menus as $menu_index => $menu): ?>
            <?php
            $menu_label = $menu['label'] ?? '';
            $menu_items = $menu['menu_items'] ?? [];
            $idx        = (int) $menu_index;
            ?>
            <div data-slot="menubar-menu" class="relative">

                <button data-slot="menubar-trigger"
                        type="button"
                        role="menuitem"
                        data-menu-index="<?= esc_attr((string) $idx) ?>"
                        :aria-expanded="(active === <?= $idx ?>).toString()"
                        :aria-haspopup="'menu'"
                        :tabindex="focusedIndex === <?= $idx ?> ? 0 : -1"
                        @click="active = active === <?= $idx ?> ? null : <?= $idx ?>"
                        @mouseenter="active !== null && (active = <?= $idx ?>)"
                        class="px-3 py-1.5 text-sm font-medium rounded-sm focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50">
                    <?= esc_html($menu_label) ?>
                </button>

                <div data-slot="menubar-content"
                     role="menu"
                     aria-label="<?= esc_attr($menu_label) ?>"
                     x-show="active === <?= $idx ?>"
                     @click.outside="active = null"
                     @keydown.escape.stop="active = null"
                     x-cloak>

                    <?php foreach ($menu_items as $item): ?>
                        <?php
                        $type  = $item['type'] ?? 'item';
                        $label = $item['label'] ?? '';
                        $href  = $item['href'] ?? '';
                        ?>
                        <?php if ($type === 'label'): ?>
                            <div data-slot="menubar-label" class="px-2 py-1.5 text-xs font-semibold">
                                <?= esc_html($label) ?>
                            </div>
                        <?php elseif ($type === 'separator'): ?>
                            <hr data-slot="menubar-separator">
                        <?php else: ?>
                            <?php if ($href): ?>
                                <a data-slot="menubar-item"
                                   role="menuitem"
                                   href="<?= esc_url($href) ?>"
                                   @click="active = null">
                                    <?= esc_html($label) ?>
                                </a>
                            <?php else: ?>
                                <button data-slot="menubar-item"
                                        type="button"
                                        role="menuitem"
                                        @click="active = null">
                                    <?= esc_html($label) ?>
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
