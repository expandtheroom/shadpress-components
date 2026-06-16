<?php

/** @var \Theme\Components\Collapsible $this */

$icon_html = !empty($this->include_icon) ? $this->render_icon() : '';
?>
<div <?= $this->component_attrs() ?>
    data-open="<?= esc_attr($this->open ? 'true' : 'false') ?>"
    x-data="<?= esc_attr($this->component_module_name()) ?>()">

    <button data-slot="collapsible-trigger"
        type="button"
        @click="toggle()"
        :aria-expanded="open.toString()"
        :data-state="open ? 'open' : 'closed'"
        class="flex w-full items-center justify-between py-2 text-sm font-medium transition-all hover:underline">

        <?= $icon_html ?>

        <?= esc_html($this->trigger_label) ?>

        <svg xmlns="http://www.w3.org/2000/svg"
            width="16" height="16"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            :class="open ? 'rotate-180' : ''"
            class="transition-transform duration-200 shrink-0"
            aria-hidden="true">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>

    <div data-slot="collapsible-content"
        x-show="open"
        :data-state="open ? 'open' : 'closed'"
        x-cloak
        class="overflow-hidden">
        <div class="py-2 text-sm">
            <?= $this->body_component ?>
        </div>
    </div>

</div>
