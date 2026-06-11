<?php

namespace Theme\Components;

class NavigationMenu extends BaseComponent {

    public function __construct(
        public string $menu_location = '',
        public string $orientation   = 'horizontal',
        public array  $extra_attrs   = []
    ) {
    }

    public function render_menu(): string {
        if ( ! $this->menu_location ) {
            return '';
        }

        ob_start();

        wp_nav_menu([
            'theme_location' => $this->menu_location,
            'container'      => false,
            'items_wrap'     => '<ul data-slot="navigation-menu-list" role="menubar" class="navigation-menu-list">%3$s</ul>',
            'walker'         => new NavigationMenuWalker(),
            'fallback_cb'    => false,
        ]);

        return ob_get_clean() ?: '';
    }

    public function menu_name(): string {
        $locations = get_nav_menu_locations();
        if ( ! isset( $locations[ $this->menu_location ] ) ) {
            return '';
        }
        $menu = wp_get_nav_menu_object( $locations[ $this->menu_location ] );
        return $menu ? esc_attr( $menu->name ) : '';
    }
}
