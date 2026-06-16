<?php
/** @var \Theme\Components\Dialog $this */
$header_icon_html = !empty($this->header_include_icon) ? $this->render_header_icon() : '';
?>
<div <?= $this->component_attrs() ?>
     x-data="<?= esc_attr($this->component_module_name()) ?>()">

    <?= $this->trigger_button ?>

    <div data-slot="dialog-overlay"
         x-show="open"
         @click="open = false"
         class="fixed inset-0 z-50 bg-black/80"
         aria-hidden="true"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak></div>

    <div role="dialog"
         aria-modal="true"
         data-slot="dialog"
         x-show="open"
         x-ref="panel"
         tabindex="-1"
         :aria-labelledby="id + '-title'"
         :data-state="open ? 'open' : 'closed'"
         @keydown.escape.window="if (open) open = false"
         class="fixed left-1/2 top-1/2 z-50 w-full max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-xl border bg-background shadow-lg p-6 max-h-[90dvh] overflow-y-auto focus:outline-none"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         x-cloak>

        <button type="button"
                data-slot="dialog-close"
                @click="open = false"
                class="absolute right-4 top-4 rounded-sm opacity-70 hover:opacity-100 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="16"
                 height="16"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 aria-hidden="true">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg>
            <span class="sr-only"><?= esc_html($this->close_label ?: 'Close') ?></span>
        </button>

        <div data-slot="dialog-header"
             class="flex flex-col gap-2 mb-4">
            <h2 data-slot="dialog-title"
                :id="id + '-title'"
                class="flex items-center gap-2 text-lg font-semibold leading-none tracking-tight">
                <?= $header_icon_html ?><?= esc_html($this->title) ?>
            </h2>
            <?php if ($this->description): ?>
                <p data-slot="dialog-description"
                   class="text-sm text-muted-foreground">
                    <?= esc_html($this->description) ?>
                </p>
            <?php endif; ?>
        </div>

        <div data-slot="dialog-content"
             class="mb-4">
            <?= $this->content_component ?>
        </div>

        <div data-slot="dialog-footer"
             class="flex justify-end">
            <button type="button"
                    data-slot="dialog-close"
                    @click="open = false"
                    class="inline-flex items-center justify-center rounded-md text-sm font-medium h-9 px-4 py-2 border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2">
                <?= esc_html($this->close_label ?: 'Close') ?>
            </button>
        </div>

    </div>

</div>
