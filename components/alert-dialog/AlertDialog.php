<?php

namespace Theme\Components;

class AlertDialog extends BaseComponent {

    public ?Button $trigger_button = null;
    public ?Button $cancel_button  = null;
    public ?Button $confirm_button = null;

    public function __construct(
        public string   $trigger_label             = '',
        public string   $title                     = '',
        public string   $description               = '',
        public string   $cancel_label              = 'Cancel',
        public string   $confirm_label             = 'Continue',
        public string   $variant                   = 'default',
        public bool|int $trigger_include_icon      = 0,
        public string   $trigger_icon_provider     = '',
        public string   $trigger_icon_lucide_icons = '',
        public string   $trigger_icon_image_icon   = '',
        public string   $trigger_icon_position     = 'left',
        public bool|int $header_include_icon       = 0,
        public string   $header_icon_provider      = '',
        public string   $header_icon_lucide_icons  = '',
        public string   $header_icon_image_icon    = '',
        public array    $extra_attrs               = []
    ) {
    }

    public function prepare(): void {
        $confirm_variant = $this->variant === 'destructive' ? 'destructive' : 'default';

        $this->trigger_button = new Button(
            variant:           'outline',
            label:             $this->trigger_label,
            include_icon:      $this->trigger_include_icon,
            icon_provider:     $this->trigger_icon_provider,
            icon_lucide_icons: $this->trigger_icon_lucide_icons,
            icon_image_icon:   $this->trigger_icon_image_icon,
            icon_position:     $this->trigger_icon_position,
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

    public function render_header_icon(): string {
        static $providers = null;
        if ($providers === null) {
            $providers = apply_filters('theme/icon_providers', []);
        }
        if (empty($providers)) return '';
        $provider_key = !empty($this->header_icon_provider)
            ? $this->header_icon_provider
            : (string) array_key_first($providers);
        $provider = $providers[$provider_key] ?? null;
        if (!$provider || !isset($provider['render'])) return '';
        $field = 'header_icon_' . str_replace('-', '_', $provider_key);
        return ($provider['render'])($this->$field ?? '');
    }
}
