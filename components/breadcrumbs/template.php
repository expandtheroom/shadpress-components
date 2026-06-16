<?php

/** @var \Theme\Components\Breadcrumbs $this */
?>
<nav <?= $this->component_attrs() ?>
    class="<?= $this->component_classes() ?>">
    <ol class="flex flex-wrap items-center gap-1.5 wrap-break-word text-sm text-muted-foreground sm:gap-2.5">
        <?php foreach ($this->crumbs as $index => $crumb): ?>
            <?php if ($index > 0): ?>
                <li role="presentation" aria-hidden="true"
                    class="select-none text-muted-foreground/60">
                    <?= esc_html($this->separator) ?>
                </li>
            <?php endif; ?>

            <li class="inline-flex items-center gap-1.5">
                <?php if (!empty($crumb['is_current'])): ?>
                    <span aria-current="page"
                        class="font-normal text-foreground">
                        <?= esc_html($crumb['link']['title'] ?? '') ?>
                    </span>
                <?php elseif (!empty($crumb['link']['url'])): ?>
                    <a href="<?= esc_url($crumb['link']['url']) ?>"
                        class="transition-colors hover:text-foreground">
                        <?= esc_html($crumb['link']['title'] ?? '') ?>
                    </a>
                <?php else: ?>
                    <span><?= esc_html($crumb['link']['title'] ?? '') ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
