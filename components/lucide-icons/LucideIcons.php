<?php

namespace Theme\Components;

class LucideIcons extends BaseComponent {

    public function __construct(
        public string $icon_name = '',
        public array $extra_attrs = []
    ) {
    }

    public function display(string $slug, array $attrs = []): void {
        $tmp = new static($slug, $attrs);
        echo '<div ' . $tmp->component_attrs() . '><div data-slot="icon">' . $tmp->get_svg() . '</div></div>';
    }

    public function get_svg(): string {
        return self::get_icons_data()[$this->icon_name] ?? '';
    }

    public function component_attrs(): string {
        $default_attrs = [
            'data-component' => $this->component_slug(),
        ];

        $compiled_attrs = [];
        foreach (array_merge($default_attrs, $this->extra_attrs) as $key => $value) {
            $compiled_attrs[] = esc_attr($key) . '="' . esc_attr($value) . '"';
        }

        $compiled_attrs[] = $this->get_anchor_attr();

        return implode(' ', array_filter($compiled_attrs));
    }

    public static function register(): void {
        \add_filter('theme/icon_providers', function ($providers) {
            $providers['lucide-icons'] = [
                'key'        => 'lucide-icons',
                'label'      => 'Lucide Icons',
                'field_type' => 'theme_icon_picker',
                'field_args' => ['label' => 'Icon'],
                'render'     => fn(string $value): string => self::get_icons_data()[$value] ?? '',
            ];
            return $providers;
        });

        if (!function_exists('acf_register_field_type'))
            return;
        require_once __DIR__ . '/LucideIconPicker.php';
        acf_register_field_type(LucideIconPicker::class);
    }

    public static function enqueue_editor_assets(): void {
        $file = __DIR__ . '/lucide-icon-picker.js';
        if (!file_exists($file))
            return;

        wp_enqueue_script(
            'shadpress-lucide-icon-picker',
            get_theme_file_uri('components/lucide-icons/lucide-icon-picker.js'),
            ['acf-input'],
            filemtime($file),
            true
        );

        wp_localize_script('shadpress-lucide-icon-picker', 'iconPickerData', [
            'iconsData' => self::get_icons_data(),
        ]);
    }

    public static function get_icons_data(): array {
        static $icons = null;
        if ($icons === null) {
            $data_file = get_stylesheet_directory() . '/components/lucide-icons/lucide-icons-data.php';
            $icons     = file_exists($data_file) ? require $data_file : [];
        }
        return $icons;
    }
}
