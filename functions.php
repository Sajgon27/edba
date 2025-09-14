<?php

require_once get_template_directory() . '/includes/block-registration.php';
require_once get_template_directory() . '/includes/blog-ajax.php';

function edba_enqueue_assets()
{
    // MAIN CSS
    wp_enqueue_style(
        'edba-style',
        get_template_directory_uri() . '/assets/css/style.css',
        []
    );

    // MAIN JS
    wp_enqueue_script(
        'edba-script',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        [],
        true
    );


    // SWIPER CSS
    wp_enqueue_style(
        'swiper-css',
        get_template_directory_uri() . '/assets/packages/swiper/swiper-bundle.min.css',
        [],
        '11.2.10'
    );

    // SWIPER JS
    wp_enqueue_script(
        'swiper-js',
        get_template_directory_uri() . '/assets/packages/swiper/swiper-bundle.min.js',
        [],
        '11.2.10',
        true
    );
}
add_action('wp_enqueue_scripts', 'edba_enqueue_assets');


// Głowny skrypt jako moduł
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if ('edba-script' === $handle) {
        return '<script type="module" src="' . esc_url($src) . '"></script>';
    }
    return $tag;
}, 10, 3);


// Custom Walker Nav Menu for the fullscreen menu
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Check if the item has children
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-submenu';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';

        // Add submenu toggle button for parent items
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '<span class="submenu-toggle"><svg width="12" height="12" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><path d="M0 4h12l-6 6z" fill="currentColor"/></svg></span>';
        }

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// Rejestracja podstawowych funkcji i menu
add_action('after_setup_theme', function () {
    add_theme_support('menus');
    add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
    register_nav_menus([
        'primary_desktop' => __('Primary Menu Desktop', 'edba'),
        'footer1' => __('Footer column 1', 'edba'),
        'footer2' => __('Footer column 2', 'edba'),
        'footer3' => __('Footer column 3', 'edba'),
        'footer4' => __('Footer column 4', 'edba'),
        'footer5' => __('Footer column 5', 'edba'),
        'footer6' => __('Footer column 6', 'edba'),

    ]);
});
