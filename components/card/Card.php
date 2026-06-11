<?php

namespace Theme\Components;

class Card extends BaseComponent {

    public function __construct(
        public string $title = '',
        public string $description = '',
        public array $image = [],
        public string $card_content = '',
        public array $link = [],
        public string $badge = '',
        public array $extra_attrs = []
    ) {
    }

    public ?Badge $badge_component = null;
    public ?Typography $content_component = null;
    public ?Button $button_component = null;

    public function prepare(): void {
        if ($this->badge) {
            $this->badge_component = new Badge(label: $this->badge);
        }
        if ($this->card_content) {
            $this->content_component = new Typography(body: $this->card_content);
        }
        if (!empty($this->link['url'])) {
            $this->button_component = new Button(link: $this->link, variant: 'outline');
        }
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
