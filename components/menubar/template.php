<?php

/** @var \Theme\Components\Menubar $this */
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?> ">
    <div data-slot="menubar"
        role="menubar"
        class="flex items-center gap-1 border border-border bg-background rounded-[calc(var(--radius)-2px)] p-1"
        <?php if ($this->label): ?>aria-label="<?= esc_attr($this->label) ?>" <?php endif; ?>
        x-data="<?= $this->component_module_name() ?>"
        data-menu-count="<?= esc_attr((string) count($this->menus)) ?>"
        @keydown.escape="active = null"
        @keydown.arrow-left.prevent="active !== null && moveFocus(-1)"
        @keydown.arrow-right.prevent="active !== null && moveFocus(1)">

        <?php foreach (array_values($this->menus) as $idx => $menu): ?>
            <?php
            $menu_label = $menu['label'] ?? '';
            $menu_items = $menu['menu_items'] ?? [];
            ?>
            <div data-slot="menubar-menu" class="relative">

                <?= $this->trigger_components[$idx] ?>

                <div data-slot="menubar-content"
                    role="menu"
                    aria-label="<?= esc_attr($menu_label) ?>"
                    x-show="active === <?= $idx ?>"
                    @click.outside="active = null"
                    @keydown.escape.stop="active = null"
                    x-cloak
                    class="absolute top-[calc(100%+0.25rem)] left-0 z-50 min-w-40 rounded-[calc(var(--radius)-2px)] border border-border bg-background p-1 shadow-md">

                    <?php foreach ($menu_items as $item): ?>
                        <?php
                        $type        = $item['type'] ?? 'item';
                        $label       = $item['label'] ?? '';
                        $link        = $item['link'] ?? [];
                        $href        = $link['url'] ?? '';
                        $link_title  = $link['title'] ?? '';
                        $target_attr = !empty($link['target']) ? 'target="' . esc_attr($link['target']) . '"' : '';
                        ?>
                        <?php if ($type === 'label'): ?>
                            <div data-slot="menubar-label" class="px-2 py-1.5 text-xs font-semibold text-muted-foreground">
                                <?= esc_html($label) ?>
                            </div>
                        <?php elseif ($type === 'separator'): ?>
                            <hr data-slot="menubar-separator" class="bg-border h-px my-1 border-none">
                        <?php else: ?>
                            <?php if ($href): ?>
                                <a data-slot="menubar-item"
                                    role="menuitem"
                                    href="<?= esc_url($href) ?>"
                                    <?= $target_attr ?>
                                    @click="active = null"
                                    class="flex w-full items-center rounded-sm px-2 py-1.5 text-sm cursor-pointer text-left hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground focus:outline-none">
                                    <?= esc_html($link_title) ?>
                                </a>
                            <?php else: ?>
                                <button data-slot="menubar-item"
                                    type="button"
                                    role="menuitem"
                                    @click="active = null"
                                    class="flex w-full items-center rounded-sm px-2 py-1.5 text-sm cursor-pointer text-left hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground focus:outline-none">
                                    <?= esc_html($link_title) ?>
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>