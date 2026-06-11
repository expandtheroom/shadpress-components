<?php

namespace Theme\Components;

class NavigationMenuWalker extends \Walker_Nav_Menu {

    /**
     * Track which items have children so we can close the x-data wrapper in end_el().
     *
     * @var int[]
     */
    private array $items_with_children = [];

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul data-slot="navigation-menu-sub-list" role="menu" x-show="open" class="navigation-menu-sub-list">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $item = $data_object;

        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes, true );

        $li_classes   = implode( ' ', array_filter( $classes ) );
        $current_attr = in_array( 'current-menu-item', $classes, true ) ? ' aria-current="page"' : '';

        if ( $depth === 0 ) {
            $output .= '<li data-slot="navigation-menu-item" role="none" class="' . esc_attr( $li_classes ) . '"' . $current_attr . '>';
        } else {
            $output .= '<li data-slot="navigation-menu-sub-item" role="none" class="' . esc_attr( $li_classes ) . '"' . $current_attr . '>';
        }

        $url   = esc_url( $item->url );
        $title = esc_html( $item->title );

        if ( $has_children && $depth === 0 ) {
            $this->items_with_children[] = $item->ID;
            $output .= '<div x-data="{open:false}">';
            $output .= '<button data-slot="navigation-menu-trigger"'
                     . ' type="button"'
                     . ' role="menuitem"'
                     . ' @click="open = !open"'
                     . ' :aria-expanded="open.toString()"'
                     . ' class="navigation-menu-trigger">'
                     . $title
                     . '</button>';
        } else {
            $output .= '<a data-slot="navigation-menu-link"'
                     . ' role="menuitem"'
                     . ' href="' . $url . '"'
                     . ' class="navigation-menu-link">'
                     . $title
                     . '</a>';
        }
    }

    public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
        $item = $data_object;

        if ( in_array( $item->ID, $this->items_with_children, true ) ) {
            $output .= '</div>';
        }

        $output .= '</li>';
    }
}
