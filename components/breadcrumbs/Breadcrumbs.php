<?php

namespace Theme\Components;

class Breadcrumbs extends BaseComponent {

    public function __construct(
        public string $source = 'auto',
        public array $crumbs = [],
        public string $separator = '/',

        // non-field properties
        public array $extra_attrs = []
    ) {
    }

    public function prepare(): void {
        if ($this->source === 'auto') {
            $this->crumbs = $this->generate_wp_breadcrumbs();
        }
    }

    protected function set_attrs(): array {
        return [
            'aria-label' => 'breadcrumb',
            ...$this->extra_attrs,
        ];
    }


    /**
     * Builds a breadcrumb trail from the current WordPress context.
     * Each item: ['link' => ['url' => '', 'title' => '', 'target' => ''], 'is_current' => bool]
     */
    private function generate_wp_breadcrumbs(): array {
        $items = [];

        $items[] = [
            'link' => ['url' => home_url('/'), 'title' => __('Home', 'shadpress'), 'target' => ''],
            'is_current' => false,
        ];

        if (is_404()) {
            $items[] = ['link' => ['url' => '', 'title' => __('Page Not Found', 'shadpress'), 'target' => ''], 'is_current' => true];
            return $items;
        }

        if (is_search()) {
            $items[] = ['link' => ['url' => '', 'title' => sprintf(__('Search: %s', 'shadpress'), get_search_query()), 'target' => ''], 'is_current' => true];
            return $items;
        }

        if (is_archive()) {
            if (is_tax() || is_category() || is_tag()) {
                $term = get_queried_object();
                if (!empty($term->parent)) {
                    $parent = get_term($term->parent, $term->taxonomy);
                    if ($parent && !is_wp_error($parent)) {
                        $items[] = ['link' => ['url' => get_term_link($parent), 'title' => $parent->name, 'target' => ''], 'is_current' => false];
                    }
                }
            }
            $items[] = ['link' => ['url' => '', 'title' => get_the_archive_title(), 'target' => ''], 'is_current' => true];
            return $items;
        }

        if (is_singular()) {
            $post = get_post();
            $post_type = get_post_type($post);

            if ($post_type === 'page') {
                // Page hierarchy: ancestor chain
                foreach (array_reverse(get_post_ancestors($post)) as $ancestor_id) {
                    $items[] = ['link' => ['url' => get_permalink($ancestor_id), 'title' => get_the_title($ancestor_id), 'target' => ''], 'is_current' => false];
                }
            } else {
                // Post type archive link
                $archive_link = get_post_type_archive_link($post_type);
                if ($archive_link) {
                    $post_type_obj = get_post_type_object($post_type);
                    $items[] = ['link' => ['url' => $archive_link, 'title' => $post_type_obj->labels->name ?? '', 'target' => ''], 'is_current' => false];
                }

                // Primary category for standard posts
                if ($post_type === 'post') {
                    $categories = get_the_category($post->ID);
                    if (!empty($categories)) {
                        $cat = $categories[0];
                        $items[] = ['link' => ['url' => get_category_link($cat->term_id), 'title' => $cat->name, 'target' => ''], 'is_current' => false];
                    }
                }
            }

            $items[] = ['link' => ['url' => '', 'title' => get_the_title($post), 'target' => ''], 'is_current' => true];
        }

        return $items;
    }
}
