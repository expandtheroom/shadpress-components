<?php

namespace Theme\Components;

class Card extends BaseComponent {

    public function __construct(
        public string   $title             = '',
        public string   $description       = '',
        public array    $image             = [],
        public string   $card_content      = '',
        public array    $link              = [],
        public string   $badge             = '',
        public bool|int $include_icon      = 0,
        public string   $icon_provider     = '',
        public string   $icon_lucide_icons = '',
        public string   $icon_image_icon   = '',
        public array    $extra_attrs       = []
    ) {
    }

    public ?Badge      $badge_component   = null;
    public ?Typography $content_component = null;
    public ?Button     $button_component  = null;

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

    public function render_icon(): string {
        static $providers = null;
        if ($providers === null) {
            $providers = apply_filters('theme/icon_providers', []);
        }
        if (empty($providers)) return '';
        $provider_key = !empty($this->icon_provider) ? $this->icon_provider : (string) array_key_first($providers);
        $provider     = $providers[$provider_key] ?? null;
        if (!$provider || !isset($provider['render'])) return '';
        $field = 'icon_' . str_replace('-', '_', $provider_key);
        return ($provider['render'])($this->$field ?? '');
    }

    protected function set_attrs(): array {
        return [
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
