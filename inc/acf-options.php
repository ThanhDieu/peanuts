<?php
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(
        array(
            'page_title' => 'Theme Options',
            'menu_title' => 'Theme Options',
            'menu_slug' => 'theme_options',
            'capability' => 'edit_posts',
            'parent_slug' => '',
            'position' => false,
            'icon_url' => false,
        )
    );
    acf_add_options_sub_page(
        array(
            'page_title' => 'Header',
            'menu_title' => 'Header',
            'menu_slug' => 'header',
            'capability' => 'edit_posts',
            'parent_slug' => 'theme_options',
            'position' => false,
            'icon_url' => false,
        )
    );
    acf_add_options_sub_page(
        array(
            'page_title' => 'Content',
            'menu_title' => 'Content',
            'menu_slug' => 'content',
            'capability' => 'edit_posts',
            'parent_slug' => 'theme_options',
            'position' => false,
            'icon_url' => false,
        )
    );
    acf_add_options_sub_page(
        array(
            'page_title' => 'Footer',
            'menu_title' => 'Footer',
            'menu_slug' => 'footer',
            'parent_slug' => 'theme_options',
            'capability' => 'edit_posts',
            'position' => false,
            'icon_url' => false,
        )
    );
}

function htmlMenu($cat, $item_output, $item)
{
    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
    $imgCat = $thumbnail_id ? wp_get_attachment_image($thumbnail_id, 'thumbnail') : '<img width="150" height="150" src="' . THEME_URL . '/images/no-image.jpg' . '" class="attachment-thumbnail size-thumbnail" alt="no image" decoding="async" loading="lazy" sizes="(max-width: 150px) 100vw, 150px">';
    $listCat = get_terms(array(
        'taxonomy' => 'product_cat',
        'parent' => $cat->term_id,
        'hide_empty' => true,
    ));

    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    $currentURL = $protocol . $host . $uri;



    $item_output .= '<div class="d-flex mega-menu-cat mb-3">';
    $item_output .= '<div class="w-4">';
    $item_output .= '<a  href="' . get_term_link($cat) . '" class="d-inline-block">';
    $item_output .= '<figure class="image-cover w-100">';
    $item_output .= $imgCat;
    $item_output .= '</figure>';
    $item_output .= '</a>';
    $item_output .= '</div>';
    $item_output .= '<div class="w-6 ps-2">';
    $item_output .= '<a  id="' . $item->ID . '" href="' . get_term_link($cat) . '" class="cat-item ' . ($currentURL === get_term_link($cat) ? 'active' : '') . '"><h2 class="bold fs-20 color-main">' . $cat->name . '</h2></a>';
    if (!empty($listCat) && !is_wp_error($listCat)) {
        $item_output .= ' <ul class="list-none ps-0">';

        foreach ($listCat as $term) {
            $item_output .= '     <li class="'  . ($currentURL === get_term_link($term) ? 'active ' : '') . $class_names . '">';
            $item_output .= '        <a href="' . get_term_link($term) . '" class="text-dark py-2 d-inline-flex a-red-hover">' . $term->name . '</a>';
            $item_output .= '    </li>';
        }

        $item_output .= '  </ul>';
    }
    $item_output .= ' </div>';
    $item_output .= '</div>';
    $result = $item_output;
    return $result;
}

class Mega_Menu_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $megaMenu = get_field('mega_menu', $item);

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $megaClass = $megaMenu ?  'has-mega-menu ' : '';

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = $class_names ? ' class="' . $megaClass . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->title) ? $item->title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>' . $atts['title'] . '</a>';

        // // Add custom ACF fields here

        if ($megaMenu) {
            $megaList = get_terms(
                array(
                    'taxonomy'     => "product_cat",
                    'hide_empty' => false,
                    'parent' => 0,
                )
            );

            $item_output .= '<div class="mega-menu py-3">';
            $item_output .= '<div class="container">';
            $item_output .= ' <div class="d-flex flex-wrap justify-content-end">';

            $item_output .= '<div class="w-25 py-lg-5 px-2 border-end">';
            foreach ($megaList as $key => $cat) {
                if ($key % 3 == 0) {
                    $item_output = htmlMenu($cat, $item_output, $item);
                }
            }
            $item_output .= '</div>';

            $item_output .= '<div class="w-25  py-lg-5 px-2 border-end ">';
            foreach ($megaList as $key => $cat) {
                if ($key % 3 == 1) {
                    $item_output = htmlMenu($cat, $item_output, $item);
                }
            }
            $item_output .= '</div>';

            $item_output .= '<div class="w-25  px-2 py-lg-5">';
            foreach ($megaList as $key => $cat) {
                if ($key % 3 == 2) {
                    $item_output = htmlMenu($cat, $item_output, $item);
                }
            }
            $item_output .= '</div>';

            $item_output .= '</div>';
            $item_output .= '</div>';
            $item_output .= '</div>';
        }


        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
add_filter('wp_nav_menu_args', 'my_mega_menu_walker');
function my_mega_menu_walker($args)
{
    $args['walker'] = new Mega_Menu_Walker();
    return $args;
}
