<?php

namespace Theme\Components;

class Alert extends BaseComponent {

    public function __construct(
        public string $title = '',
        public string $description = '',
        public string $variant = 'default',
        public bool $dismissible = false,
        public array $extra_attrs = []
    ) {
    }

    public function alert_classes(): string {
        $padding = $this->dismissible ? 'pl-4 pr-8' : 'px-4';
        $base = "relative w-full rounded-lg border {$padding} py-3 text-sm grid grid-cols-[0_1fr] gap-y-0.5 *:col-start-2";

        $variant_classes = match ($this->variant) {
            'destructive' => 'text-destructive bg-card [&>svg]:text-current *:data-[slot=alert-description]:text-destructive/80',
            default => 'bg-card text-card-foreground',
        };

        return "$base $variant_classes";
    }

    protected function set_attrs(): array {
        return [
            'data-variant' => $this->variant,
            'role' => 'alert',
            'data-slot' => $this->component_slug(),
            ...$this->extra_attrs,
        ];
    }
}
