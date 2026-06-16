<?php

namespace Theme\Components;

class Carousel extends BaseComponent {

    public function __construct(
        public array $slides         = [],
        public bool  $loop           = false,
        public bool  $autoplay       = false,
        public int   $autoplay_delay = 3000,
        public array $extra_attrs    = []
    ) {
    }

    public function prepare(): void {
        $this->slides = array_map(function (array $slide): array {
            return [
                'image'       => $slide['image']       ?? [],
                'title'       => $slide['title']       ?? '',
                'description' => $slide['description'] ?? '',
            ];
        }, $this->slides);

        if ($this->autoplay_delay < 500) {
            $this->autoplay_delay = 3000;
        }
    }

    public function slide_count(): int {
        return count($this->slides);
    }

    protected function set_attrs(): array {
        return [
            'data-loop' => $this->loop ? 'true' : 'false',
            'data-autoplay' => $this->autoplay ? 'true' : 'false',
            'data-autoplay-delay' => $this->autoplay_delay,
            'aria-roledescription' => 'carousel',
            'aria-label' => 'Carousel',
            ...$this->extra_attrs,
        ];
    }
}
