<?php

/** @var \Theme\Components\Carousel $this */
$total = $this->slide_count();
?>
<div <?= $this->component_attrs() ?> class="<?= $this->component_classes() ?>"
    x-data="<?= $this->component_module_name() ?>">

    <div data-slot="carousel-viewport" class="relative overflow-hidden">

        <div data-slot="carousel-track"
            x-ref="track"
            class="flex overflow-x-scroll snap-x snap-mandatory scroll-smooth scrollbar-none [&::-webkit-scrollbar]:hidden">

            <?php foreach ($this->slides as $index => $slide): ?>
                <div data-slot="carousel-item"
                    role="group"
                    aria-roledescription="slide"
                    aria-label="Slide <?= esc_attr($index + 1) ?> of <?= esc_attr($total) ?>"
                    class="shrink-0 w-full snap-start">

                    <?php if (!empty($slide['image']['url'])): ?>
                        <img src="<?= esc_url($slide['image']['url']) ?>"
                            alt="<?= esc_attr($slide['image']['alt'] ?? '') ?>"
                            <?php if (!empty($slide['image']['width'])): ?>width="<?= esc_attr($slide['image']['width']) ?>" <?php endif; ?>
                            <?php if (!empty($slide['image']['height'])): ?>height="<?= esc_attr($slide['image']['height']) ?>" <?php endif; ?>
                            loading="<?= $index === 0 ? 'eager' : 'lazy' ?>"
                            class="w-full object-cover">
                    <?php endif; ?>

                    <?php if ($slide['title'] || $slide['description']): ?>
                        <div data-slot="carousel-item-body" class="p-4">
                            <?php if ($slide['title']): ?>
                                <h3 data-slot="carousel-item-title" class="text-lg font-semibold">
                                    <?= esc_html($slide['title']) ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($slide['description']): ?>
                                <p data-slot="carousel-item-description" class="text-sm text-muted-foreground mt-1">
                                    <?= esc_html($slide['description']) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

        </div>

        <button data-slot="carousel-prev"
            type="button"
            @click="prev()"
            :disabled="!loop && active === 0 || null"
            aria-label="Previous slide"
            class="absolute left-3 top-1/2 -translate-y-1/2 z-10 inline-flex items-center justify-center size-8 rounded-full bg-background border border-border text-foreground transition-colors duration-150 hover:bg-accent disabled:opacity-50 disabled:pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </button>

        <button data-slot="carousel-next"
            type="button"
            @click="next()"
            :disabled="!loop && active === totalCount - 1 || null"
            aria-label="Next slide"
            class="absolute right-3 top-1/2 -translate-y-1/2 z-10 inline-flex items-center justify-center size-8 rounded-full bg-background border border-border text-foreground transition-colors duration-150 hover:bg-accent disabled:opacity-50 disabled:pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </button>

    </div>

    <div x-ref="liveRegion" aria-live="polite" aria-atomic="true" class="sr-only"></div>

    <?php if ($total > 1): ?>
        <div data-slot="carousel-dots"
            aria-label="Carousel navigation"
            class="flex justify-center gap-2 mt-4">
            <?php for ($i = 0; $i < $total; $i++): ?>
                <button data-slot="carousel-dot"
                    type="button"
                    :aria-pressed="active === <?= esc_attr($i) ?> ? 'true' : 'false'"
                    @click="goTo(<?= esc_attr($i) ?>)"
                    aria-label="Slide <?= esc_attr($i + 1) ?> of <?= esc_attr($total) ?>"
                    class="w-2 h-2 rounded-full transition-colors cursor-pointer bg-border aria-pressed:bg-primary">
                </button>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

</div>