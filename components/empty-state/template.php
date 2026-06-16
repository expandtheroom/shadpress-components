<?php

/** @var \Theme\Components\EmptyState $this */
?>
<div <?= $this->component_attrs() ?> class="<?= classNames($this->component_classes(), 'flex flex-col items-center text-center gap-4 py-12 px-6') ?>">

    <div data-slot="empty-state-icon"
        aria-hidden="true"
        class="<?= classNames('w-12 h-12 [&_svg]:w-12 [&_svg]:h-12 text-muted-foreground flex items-center justify-center') ?>">

        <?php if (!empty($this->include_icon)): ?>
            <?= $this->render_icon() ?>
        <?php else: ?>
            <svg xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M22 12h-6l-2 3H10l-2-3H2" />
                <path
                    d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z" />
            </svg>
        <?php endif; ?>

    </div>

    <h3 data-slot="empty-state-title" class="text-lg font-semibold text-foreground">
        <?= esc_html($this->title) ?>
    </h3>

    <?php if ($this->description): ?>
        <p data-slot="empty-state-description" class="text-sm text-muted-foreground max-w-96">
            <?= esc_html($this->description) ?>
        </p>
    <?php endif; ?>

    <?php if ($this->action_button): ?>
        <?= $this->action_button ?>
    <?php endif; ?>

</div>
