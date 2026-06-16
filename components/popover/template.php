<?php

/** @var \Theme\Components\Popover $this */
$side  = in_array($this->side,  ['top', 'right', 'bottom', 'left'], true) ? $this->side  : 'bottom';
$align = in_array($this->align, ['start', 'center', 'end'],          true) ? $this->align : 'center';
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?>"
    x-data="<?= esc_attr($this->component_module_name()) ?>()">

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
            class="absolute z-50 w-72 rounded-md border p-4 text-sm shadow-md outline-none data-[side=bottom]:top-[calc(100%+0.5rem)] data-[side=bottom]:left-1/2 data-[side=bottom]:-translate-x-1/2 data-[side=bottom]:data-[align=start]:left-0 data-[side=bottom]:data-[align=start]:transform-none data-[side=bottom]:data-[align=end]:left-auto data-[side=bottom]:data-[align=end]:right-0 data-[side=bottom]:data-[align=end]:transform-none data-[side=top]:bottom-[calc(100%+0.5rem)] data-[side=top]:top-auto data-[side=top]:left-1/2 data-[side=top]:-translate-x-1/2 data-[side=top]:data-[align=start]:left-0 data-[side=top]:data-[align=start]:transform-none data-[side=top]:data-[align=end]:left-auto data-[side=top]:data-[align=end]:right-0 data-[side=top]:data-[align=end]:transform-none data-[side=right]:left-[calc(100%+0.5rem)] data-[side=right]:top-1/2 data-[side=right]:-translate-y-1/2 data-[side=right]:data-[align=start]:top-0 data-[side=right]:data-[align=start]:transform-none data-[side=right]:data-[align=end]:top-auto data-[side=right]:data-[align=end]:bottom-0 data-[side=right]:data-[align=end]:transform-none data-[side=left]:right-[calc(100%+0.5rem)] data-[side=left]:left-auto data-[side=left]:top-1/2 data-[side=left]:-translate-y-1/2 data-[side=left]:data-[align=start]:top-0 data-[side=left]:data-[align=start]:transform-none data-[side=left]:data-[align=end]:top-auto data-[side=left]:data-[align=end]:bottom-0 data-[side=left]:data-[align=end]:transform-none"
            x-cloak
            style="background-color: var(--color-popover); color: var(--color-popover-foreground);">
            <?= $this->body_component ?>
        </div>

    </div>

</div>
