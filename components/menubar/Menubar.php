<?php

namespace Theme\Components;

class Menubar extends BaseComponent {

    /** @var Button[] */
    public array $trigger_components = [];

    public function __construct(
        public string $label       = '',
        public array  $menus       = [],
        public array  $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->trigger_components = [];
        foreach (array_values($this->menus) as $idx => $menu) {
            $this->trigger_components[] = new Button(
                variant: 'ghost',
                size:    'sm',
                label:   $menu['label'] ?? '',
                extra_attrs: [
                    'data-slot'       => 'menubar-trigger',
                    'role'            => 'menuitem',
                    'aria-haspopup'   => 'menu',
                    'data-menu-index' => (string) $idx,
                ],
            );
        }
    }

    protected function set_attrs(): array {
        return [
            'data-type' => $this->type,
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
