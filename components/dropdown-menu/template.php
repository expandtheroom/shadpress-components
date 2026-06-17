<?php

/** @var \Theme\Components\DropdownMenu $this */
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?>">
    <div data-slot="dropdown-menu"
        class="relative inline-block"
        x-data="<?= $this->component_module_name() ?>">

        <?= $this->trigger_component ?>

        <div data-slot="dropdown-menu-content"
            role="menu"
            aria-label="<?= esc_attr($this->trigger_label) ?>"
            x-show="open"
            @click.outside="open = false"
            @keydown.escape="open = false; $refs.trigger.focus()"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            x-cloak
            class="absolute top-[calc(100%+0.25rem)] left-0 z-50 min-w-40 rounded-[calc(var(--radius)-2px)] border border-border bg-background p-1 shadow-md">

            <?php foreach ($this->menu_items as $item): ?>
                <?php
                $type  = $item['type'] ?? 'item';
                $label = $item['label'] ?? '';
                $href  = $item['href'] ?? '';
                ?>
                <?php if ($type === 'label'): ?>
                    <div data-slot="dropdown-menu-label" class="px-2 py-1.5 text-xs font-semibold text-muted-foreground">
                        <?= esc_html($label) ?>
                    </div>
                <?php elseif ($type === 'separator'): ?>
                    <hr data-slot="dropdown-menu-separator" class="bg-border h-px my-1 border-none">
                <?php else: ?>
                    <?php if ($href): ?>
                        <a data-slot="dropdown-menu-item"
                            role="menuitem"
                            href="<?= esc_url($href) ?>"
                            @click="open = false"
                            class="flex w-full items-center rounded-sm px-2 py-1.5 text-sm cursor-pointer text-left hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground focus:outline-none">
                            <?= esc_html($label) ?>
                        </a>
                    <?php else: ?>
                        <button data-slot="dropdown-menu-item"
                            type="button"
                            role="menuitem"
                            @click="open = false"
                            class="flex w-full items-center rounded-sm px-2 py-1.5 text-sm cursor-pointer text-left hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground focus:outline-none">
                            <?= esc_html($label) ?>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>