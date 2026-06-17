<?php

namespace Theme\Components;

class DropdownMenu extends BaseComponent {

    public ?Button $trigger_component = null;

    public function __construct(
        public string $trigger_label   = '',
        public string $trigger_variant = 'default',
        public array  $menu_items      = [],
        public array  $extra_attrs     = []
    ) {
    }

    public function prepare(): void {
        $this->trigger_component = new Button(
            variant: $this->trigger_variant,
            label:   $this->trigger_label,
            extra_attrs: [
                'data-slot' => 'dropdown-menu-trigger',
                'x-ref'     => 'trigger',
            ],
        );
    }
}
