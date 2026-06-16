<?php
/** @var \Theme\Components\Card $this */

$icon_html = !empty($this->include_icon) ? $this->render_icon() : '';
?>
<div <?= $this->component_attrs() ?>
     class="<?= esc_attr(classNames(
         $this->component_classes(),
         'bg-card text-card-foreground flex flex-col gap-6 rounded-xl border py-6 shadow-sm',
     )) ?>">

    <?php if (!empty($this->image['url'])): ?>
        <div class="-mt-6 aspect-video overflow-hidden rounded-t-xl">
            <img src="<?= esc_url($this->image['url']) ?>"
                 alt="<?= esc_attr($this->image['alt'] ?? '') ?>"
                 class="w-full h-full object-contain">
        </div>
    <?php endif; ?>

    <div data-slot="card-header"
         class="flex flex-col gap-1.5 px-6">

        <?php if ($this->badge_component): ?>
            <?= $this->badge_component ?>
        <?php endif; ?>

        <?php if ($this->title || $icon_html): ?>
            <div data-slot="card-title"
                 class="leading-none font-semibold flex items-center gap-2">
                <?= $icon_html ?>
                <?= esc_html($this->title) ?>
            </div>
        <?php endif; ?>

        <?php if ($this->description): ?>
            <div data-slot="card-description"
                 class="text-muted-foreground text-sm">
                 <?= esc_html($this->description) ?>
            </div>
        <?php endif; ?>

    </div>

    <?php if ($this->content_component): ?>
        <div data-slot="card-content"
             class="px-6">
            <?= $this->content_component ?>
        </div>
    <?php endif; ?>

    <?php if ($this->button_component): ?>
        <div data-slot="card-footer"
             class="flex items-center px-6">
            <?= $this->button_component ?>
        </div>
    <?php endif; ?>

</div>
