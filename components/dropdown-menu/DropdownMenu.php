<?php

namespace Theme\Components;

class DropdownMenu extends BaseComponent {

    public function __construct(
        public string $trigger_label   = '',
        public string $trigger_variant = 'default',
        public array  $menu_items      = [],
        public array  $extra_attrs     = []
    ) {
    }

    public function trigger_classes(): string {
        $base = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all cursor-pointer focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2';

        $variant = match ($this->trigger_variant) {
            'outline'   => 'border shadow-xs hover:bg-accent hover:text-accent-foreground',
            'secondary' => 'shadow-xs hover:opacity-80',
            'ghost'     => 'hover:bg-accent hover:text-accent-foreground',
            default     => 'shadow-xs',
        };

        return "$base $variant";
    }

    public function trigger_style(): string {
        return match ($this->trigger_variant) {
            'outline'   => 'border-color: var(--color-input); background-color: var(--color-background);',
            'secondary' => 'background-color: var(--color-secondary); color: var(--color-secondary-foreground);',
            'ghost'     => '',
            default     => 'background-color: var(--color-primary); color: var(--color-primary-foreground);',
        };
    }

}
