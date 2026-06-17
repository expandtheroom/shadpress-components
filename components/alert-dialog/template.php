<?php

/** @var \Theme\Components\AlertDialog $this */

$header_icon_html = !empty($this->header_include_icon) ? $this->render_header_icon() : '';
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?>"
    x-data="<?= $this->component_module_name() ?>">

    <?= $this->trigger_button ?>

    <div data-slot="alert-dialog-overlay"
        x-show="open"
        @click="open = false"
        class="fixed inset-0 z-50 bg-black/80"
        x-cloak
        aria-hidden="true"></div>

    <div role="alertdialog"
        aria-modal="true"
        data-slot="alert-dialog-content"
        x-show="open"
        @keydown.escape.window="if (open) open = false"
        class="fixed left-1/2 top-1/2 z-50 w-full max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-xl border bg-background p-6 shadow-lg"
        x-cloak
        :aria-labelledby="'alert-dialog-title-' + $id('alert-dialog')"
        :aria-describedby="'alert-dialog-desc-' + $id('alert-dialog')">

        <div data-slot="alert-dialog-header" class="flex flex-col gap-2 text-center sm:text-left">
            <h2 data-slot="alert-dialog-title"
                :id="'alert-dialog-title-' + $id('alert-dialog')"
                class="text-lg font-semibold flex items-center gap-2">
                <?= $header_icon_html ?>
                <?= esc_html($this->title) ?>
            </h2>
            <?php if ($this->description): ?>
                <p data-slot="alert-dialog-description"
                    :id="'alert-dialog-desc-' + $id('alert-dialog')"
                    class="text-sm text-muted-foreground">
                    <?= esc_html($this->description) ?>
                </p>
            <?php endif; ?>
        </div>

        <div data-slot="alert-dialog-footer" class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end mt-4">
            <?= $this->cancel_button ?>
            <?= $this->confirm_button ?>
        </div>

    </div>

</div>