<?php
/*
 *  GLOBAL VARIABLES
 */

define('THEME_DIR', get_stylesheet_directory());
define('THEME_URL', get_stylesheet_directory_uri());

/*
 *  INCLUDED FILES
 */

add_editor_style('css/button-web.css');

$file_includes = [
    'inc/theme-assets.php',
    'inc/theme-setup.php',
    'inc/acf-options.php',
    'inc/theme-shortcode.php',
    'inc/button-editer.php',
    'inc/theme-config.php',
    'inc/woocommerce-setup.php',

];

foreach ($file_includes as $file) {
    if (!$filePath = locate_template($file)) {
        trigger_error(sprintf(__('Missing included file'), $file), E_USER_ERROR);
    }

    require_once $filePath;
}

unset($file, $filePath);

function admin_custom_css()
{
    echo '<style>
        body #wpcontent #wpbody #wpbody-content a[href*="www.gravityforms.com/pricing"] {
		    position: fixed;
    opacity: 0;
    bottom: 0;
    height: 0;
    min-width: 0 !important;
    width: 0;
    overflow: hidden;
		}
    </style>';
}
add_action('admin_head', 'admin_custom_css');
