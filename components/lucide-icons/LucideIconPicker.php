<?php

namespace Theme\Components;

if (!class_exists('acf_field'))
    return;

class LucideIconPicker extends \acf_field {

    public function initialize(): void {
        $this->name     = 'theme_icon_picker';
        $this->label    = 'Icon Picker';
        $this->category = 'content';
        $this->defaults = [
            'value'   => '',
            'include' => [],
            'ignore'  => [],
        ];
    }

    public function render_field($field): void {
        $value   = $field['value'] ?? '';
        $include = $field['include'] ?? [];
        $ignore  = $field['ignore'] ?? [];
        $groups  = $this->build_optgroups($include, $ignore);
        ?>
        <select id="<?= esc_attr($field['id']) ?>"
                name="<?= esc_attr($field['name']) ?>"
                class="acf-icon-select">
            <option value="">— Select an icon —</option>
            <?php foreach ($groups as $label => $icons) : ?>
                <optgroup label="<?= esc_attr($label) ?>">
                    <?php foreach ($icons as $icon) : ?>
                        <option value="<?= esc_attr($icon) ?>"<?= selected($value, $icon, false) ?>>
                            <?= esc_html($icon) ?>
                        </option>
                    <?php endforeach ?>
                </optgroup>
            <?php endforeach ?>
        </select>
        <?php
    }

    public function update_value($value, $post_id, $field) {
        return sanitize_key($value);
    }

    public function load_value($value, $post_id, $field) {
        return $value;
    }

    private function get_category_data(): array {
        static $data = null;
        if ($data === null) {
            $file = __DIR__ . '/icon-categories.json';
            $data = file_exists($file)
                ? json_decode(file_get_contents($file), true)
                : [];
        }
        return $data;
    }

    private function build_optgroups(array $include, array $ignore): array {
        $data            = $this->get_category_data();
        $category_map    = $data['categoryMap'] ?? [];
        $icon_categories = $data['iconCategories'] ?? [];

        // Invert iconCategories: category slug → [icon slugs]
        $by_category = [];
        foreach ($icon_categories as $icon => $cats) {
            foreach ($cats as $cat) {
                $by_category[$cat][] = $icon;
            }
        }

        $groups = [];
        foreach ($category_map as $slug => $label) {
            if (!empty($include) && !in_array($slug, $include, true)) continue;
            if (empty($include) && !empty($ignore) && in_array($slug, $ignore, true)) continue;

            $icons = $by_category[$slug] ?? [];
            if (empty($icons)) continue;

            sort($icons);
            $groups[$label] = $icons;
        }

        return $groups;
    }
}
