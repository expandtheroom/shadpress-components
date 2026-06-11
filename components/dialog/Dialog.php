<?php

namespace Theme\Components;

class Dialog extends BaseComponent {

    public function __construct(
        public string $trigger_label = '',
        public string $trigger_variant = 'default',
        public string $title = '',
        public string $description = '',
        public string $dialog_content = '',
        public string $close_label = 'Close',
        public array $extra_attrs = []
    ) {
    }

    public ?Typography $content_component = null;

    public function prepare(): void {
        $this->content_component = new Typography(body: $this->dialog_content);
    }

    public function trigger_classes(): string {
        $base = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all cursor-pointer focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2';

        $variant = match ($this->trigger_variant) {
            'outline' => 'border border-input bg-background shadow-xs hover:bg-accent hover:text-accent-foreground',
            'secondary' => 'bg-secondary text-secondary-foreground shadow-xs hover:bg-secondary/80',
            'ghost' => 'hover:bg-accent hover:text-accent-foreground',
            default => 'bg-primary text-primary-foreground shadow-xs hover:bg-primary/90',
        };

        return "$base $variant";
    }

}
