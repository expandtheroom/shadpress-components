<?php

namespace Theme\Components;

class ButtonGroup extends BaseComponent {

    /** @var Button[] */
    public array $button_components = [];

    public function __construct(
        public string $orientation = 'horizontal',
        public string $spacing = 'conjoined',
        public string $size = 'default',
        public array $buttons = [],

        // non-field properties
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        $this->button_components = array_map(
            fn(array $button_data) => new Button(
                variant: $button_data['variant'] ?? 'default',
                size: $this->size,
                link: $button_data['link'] ?? [],
            ),
            $this->buttons,
        );
    }

    protected function set_attrs(): array {
        return [
            'role' => 'group',
            ...$this->extra_attrs,
        ];
    }

    public function alignment_classes(): string {
        $align = $this->block['align'] ?? '';
        if (!$align) {
            return '';
        }

        if ($this->orientation === 'vertical') {
            return match ($align) {
                'left' => 'items-start',
                'right' => 'items-end',
                default => 'items-center',
            };
        }

        return match ($align) {
            'left' => 'justify-start',
            'right' => 'justify-end',
            default => 'justify-center',
        };
    }

    public function spacing_classes(): string {
        if ($this->spacing === 'conjoined') {
            $inner = '[&>*:not(:first-child):not(:last-child)]:rounded-none';
            return $this->orientation === 'vertical'
                ? "$inner [&>*:first-child]:rounded-b-none [&>*:last-child]:rounded-t-none"
                : "$inner [&>*:first-child]:rounded-r-none [&>*:last-child]:rounded-l-none";
        }

        return match ($this->spacing) {
            'xs' => 'gap-1',
            'sm' => 'gap-2',
            'lg' => 'gap-6',
            default => 'gap-4', // 'md'
        };
    }

    public function wrapper_classes(): string {
        return classNames(
            'flex w-full',
            $this->orientation === 'vertical' ? 'flex-col' : 'flex-row',
            $this->spacing_classes(),
            $this->alignment_classes(),
        );
    }
}
