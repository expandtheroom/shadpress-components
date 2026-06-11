<?php

namespace Theme\Components;

class ImageIcon extends BaseComponent {

    public function __construct(
        public string $icon = '',
    ) {
    }

    public static function register(): void {
        \add_filter('theme/icon_providers', function ($providers) {
            $providers['image-icon'] = [
                'key'        => 'image-icon',
                'label'      => 'Image Icon',
                'field_type' => 'icon_picker',
                'field_args' => [
                    'label'         => 'Icon',
                    'tabs'          => ['media_library', 'url'],
                    'return_format' => 'string',
                ],
                'render'     => fn(string $value): string => !empty($value)
                    ? '<img src="' . esc_url($value) . '" alt="" class="size-4">'
                    : '',
            ];
            return $providers;
        });
    }
}
