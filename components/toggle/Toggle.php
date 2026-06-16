<?php

namespace Theme\Components;

class Toggle extends BaseComponent {

    public function __construct(
        public string $label = '',
        public bool $checked = false,
        public string $variant = 'default',
        public string $size = 'default',
        public bool $disabled = false,
        public bool $required = false,
        public string $name = '',
        public string $value = '1',
        public array $extra_attrs = []
    ) {
    }

    public function toggle_classes(): string {
        $classes = [
            'inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium',
            'transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring',
            'disabled:pointer-events-none disabled:opacity-50',
        ];

        $variant = in_array($this->variant, ['default', 'outline'], true) ? $this->variant : 'default';
        if ($variant === 'outline') {
            $classes[] = 'border bg-transparent hover:bg-accent hover:text-accent-foreground';
        } else {
            $classes[] = 'bg-transparent hover:bg-muted hover:text-muted-foreground';
        }

        $size = in_array($this->size, ['default', 'sm', 'lg'], true) ? $this->size : 'default';
        if ($size === 'sm') {
            $classes[] = 'h-8 px-2';
        } elseif ($size === 'lg') {
            $classes[] = 'h-11 px-5';
        } else {
            $classes[] = 'h-9 px-2.5';
        }

        return implode(' ', $classes);
    }


    protected function set_attrs(): array {
        return [
            'data-checked' => $this->checked ? 'true' : 'false',
            'data-disabled' => $this->disabled ? 'true' : 'false',
            ...$this->extra_attrs,
        ];
    }
}
