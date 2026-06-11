<?php
/** @var \Theme\Components\Popover $this */
$side  = in_array($this->side,  ['top', 'right', 'bottom', 'left'], true) ? $this->side  : 'bottom';
$align = in_array($this->align, ['start', 'center', 'end'],          true) ? $this->align : 'center';
?>
<div <?= $this->component_attrs() ?>
     x-data="<?= esc_attr($this->component_module_name()) ?>()"
     data-side="<?= esc_attr($side) ?>"
     data-align="<?= esc_attr($align) ?>">

    <div class="relative inline-block">

        <button data-slot="popover-trigger"
                type="button"
                @click="open = !open"
                :aria-expanded="open.toString()"
                class="inline-flex h-9 items-center justify-center rounded-md border px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring">
            <?= esc_html($this->trigger_label) ?>
        </button>

        <div data-slot="popover-content"
             x-show="open"
             @click.outside="open = false"
             @keydown.escape="open = false"
             :data-side="side"
             :data-align="align"
             class="<?= esc_attr($this->popover_content_classes()) ?>"
             x-cloak
             style="background-color: var(--color-popover); color: var(--color-popover-foreground);">
            <?= $this->body_component ?>
        </div>

    </div>

</div>
