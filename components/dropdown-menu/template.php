<?php
/** @var \Theme\Components\DropdownMenu $this */
?>
<div <?= $this->component_attrs() ?>>
    <div data-slot="dropdown-menu"
         class="relative inline-block"
         x-data="<?= esc_attr($this->component_module_name()) ?>()">

        <button data-slot="dropdown-menu-trigger"
                type="button"
                x-ref="trigger"
                :aria-expanded="open.toString()"
                @click="open = !open"
                class="<?= esc_attr($this->trigger_classes()) ?>"
                style="<?= esc_attr($this->trigger_style()) ?>">
            <?= esc_html($this->trigger_label) ?>
        </button>

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
             x-cloak>

            <?php foreach ($this->menu_items as $item): ?>
                <?php
                $type  = $item['type'] ?? 'item';
                $label = $item['label'] ?? '';
                $href  = $item['href'] ?? '';
                ?>
                <?php if ($type === 'label'): ?>
                    <div data-slot="dropdown-menu-label" class="px-2 py-1.5 text-xs font-semibold">
                        <?= esc_html($label) ?>
                    </div>
                <?php elseif ($type === 'separator'): ?>
                    <hr data-slot="dropdown-menu-separator">
                <?php else: ?>
                    <?php if ($href): ?>
                        <a data-slot="dropdown-menu-item"
                           role="menuitem"
                           href="<?= esc_url($href) ?>"
                           @click="open = false">
                            <?= esc_html($label) ?>
                        </a>
                    <?php else: ?>
                        <button data-slot="dropdown-menu-item"
                                type="button"
                                role="menuitem"
                                @click="open = false">
                            <?= esc_html($label) ?>
                        </button>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
</div>
