<?php

namespace Theme\Components;

class AlertDialog extends BaseComponent {

    public ?Button $trigger_button = null;
    public ?Button $cancel_button  = null;
    public ?Button $confirm_button = null;

    public function __construct(
        public string $trigger_label = '',
        public string $title         = '',
        public string $description   = '',
        public string $cancel_label  = 'Cancel',
        public string $confirm_label = 'Continue',
        public string $variant       = 'default',
        public array  $extra_attrs   = []
    ) {
    }

    public function prepare(): void {
        $confirm_variant = $this->variant === 'destructive' ? 'destructive' : 'default';

        $this->trigger_button = new Button(
            variant: 'outline',
            label: $this->trigger_label,
            extra_attrs: [
                'data-slot' => 'alert-dialog-trigger',
                '@click'    => 'open = true',
            ]
        );

        $this->cancel_button = new Button(
            variant: 'outline',
            label: $this->cancel_label,
            extra_attrs: [
                'data-slot' => 'alert-dialog-cancel',
                '@click'    => 'open = false',
            ]
        );

        $this->confirm_button = new Button(
            variant: $confirm_variant,
            label: $this->confirm_label,
            extra_attrs: [
                'data-slot' => 'alert-dialog-action',
                '@click'    => 'open = false',
            ]
        );
    }
}
