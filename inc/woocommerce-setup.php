<?php

//Add Template Woocommerce
$storefront = (object)array(
    'main' => require 'class-storefront.php',
);


//Sửa Đổi Mặc Định gallery của woocommerce
add_action('after_setup_theme', 'yourtheme_setup');
function yourtheme_setup()
{
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}


// Tối ưu Woocommerce css, js
add_action('wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99);

function child_manage_woocommerce_styles()
{
    remove_action('wp_head', array($GLOBALS['woocommerce'], 'generator'));
    if (function_exists('is_woocommerce')) {
        if (!is_woocommerce() && !is_cart() && !is_checkout()) {
            wp_dequeue_style('woocommerce_frontend_styles');
            wp_dequeue_style('woocommerce_fancybox_styles');
            wp_dequeue_style('woocommerce_chosen_styles');
            wp_dequeue_style('woocommerce_prettyPhoto_css');
            wp_dequeue_script('wc_price_slider');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-add-to-cart');
            wp_dequeue_script('wc-cart-fragments');
            wp_dequeue_script('wc-checkout');
            wp_dequeue_script('wc-add-to-cart-variation');
            wp_dequeue_script('wc-single-product');
            wp_dequeue_script('wc-cart');
            wp_dequeue_script('wc-chosen');
            wp_dequeue_script('woocommerce');
            wp_dequeue_script('prettyPhoto');
            wp_dequeue_script('prettyPhoto-init');
            wp_dequeue_script('jquery-blockui');
            wp_dequeue_script('jquery-placeholder');
            wp_dequeue_script('fancybox');
            wp_dequeue_script('jqueryui');
        }
    }
}


add_filter('woocommerce_checkout_fields', 'custom_checkout_form');
function custom_checkout_form($fields)
{
    unset($fields['billing']['billing_postcode']); //Ẩn postCode
    unset($fields['billing']['billing_state']); //Ẩn bang hạt
    unset($fields['billing']['billing_address_2']); //Ẩn địa chỉ 2
    unset($fields['billing']['billing_company']); //Ẩn công ty
    //    unset($fields['billing']['billing_country']);// Ẩn quốc gia
    unset($fields['billing']['billing_last_name']); //Ẩn last name
    unset($fields['billing']['billing_city']); //Ẩn select box chọn thành phố
    return $fields;
}

function custom_checkout_field_label($fields)
{
    $fields['first_name']['label'] = 'Họ và tên';
    return $fields;
}

add_filter('woocommerce_default_address_fields', 'custom_checkout_field_label');


// Hiển thị "Còn Hàng" / "Tạm hết hàng"
add_filter('woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability($availability, $_product)
{

    // Change In Stock Text
    $currentlang = get_bloginfo('language');
    if ($_product->is_in_stock()) {
        if ($currentlang == "vi") :
            $availability['availability'] = __('Còn hàng', 'woocommerce');
        elseif ($currentlang == "en-GB") :
            $availability['availability'] = __('Available', 'woocommerce');
        endif;
    }
    // Change Out of Stock Text
    if (!$_product->is_in_stock()) {
        if ($currentlang == "vi") :
            $availability['availability'] = __('Tạm hết hàng', 'woocommerce');
        elseif ($currentlang == "en-GB") :
            $availability['availability'] = __('Sold Out', 'woocommerce');
        endif;
    }
    return $availability;
}


// Giới hạn columns sản phẩm 
add_filter('loop_shop_columns', 'my_shop_view_mode', 20);
function my_shop_view_mode($columns)
{
    $default = 4; // Set the default number of columns here
    if (isset($_GET['view_mode']) && $_GET['view_mode'] == 'list') {
        $columns = 1;
    } else {
        $columns = $default;
    }
    return $columns;
}

// Giới hạn số lượng sản phẩm 

add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);
function new_loop_shop_per_page($cols)
{
    $default = 12; // Set the default number of products per page here
    if (isset($_GET['products_per_page']) && !empty($_GET['products_per_page'])) {
        $cols = absint($_GET['products_per_page']);
    } else {
        $cols = $default;
    }
    return $cols;
}

add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

// Button Mua ngay
add_action('woocommerce_after_add_to_cart_button', 'devvn_quickbuy_after_addtocart_button');
function devvn_quickbuy_after_addtocart_button()
{
    global $product;
?>
    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_buy_now_button button alt" id="buy_now_button">
        MUA NGAY
    </button>
    <input type="hidden" name="is_buy_now" id="is_buy_now" value="0" />
    <script>
        jQuery(document).ready(function() {
            jQuery('body').on('click', '#buy_now_button', function() {
                if (jQuery(this).hasClass('disabled')) return;
                var thisParent = jQuery(this).closest('form.cart');
                jQuery('#is_buy_now', thisParent).val('1');
                thisParent.submit();
            });
        });
    </script>
<?php
}

add_filter('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout($redirect_url)
{
    if (isset($_REQUEST['is_buy_now']) && $_REQUEST['is_buy_now']) {
        $redirect_url = wc_get_checkout_url();
    }
    return $redirect_url;
}

//tabs
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs)
{
    unset($tabs['reviews']);
    unset($tabs['additional_information']);
    return $tabs;
}

add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
function woo_rename_tabs($tabs)
{
    $tabs['description']['title'] = __('THÔNG TIN SẢN PHẨM');
    return $tabs;
}

/**
 * Add a custom product data tab
 */
add_filter('woocommerce_product_tabs', 'woo_new_product_tab');
function woo_new_product_tab($tabs)
{

    // Adds the new tab

    $tabs['test_tab'] = array(
        'title' => __('CHÍNH SÁCH BẢO HÀNH', 'woocommerce'),
        'priority' => 50,
        'callback' => 'woo_new_product_tab_content'
    );

    return $tabs;
}

function woo_new_product_tab_content()
{

    echo get_field('product_policy', get_the_ID());
}

if ('yes' === get_option('woocommerce_enable_ajax_add_to_cart')) {
    add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
    add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
}
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
function woocommerce_ajax_add_to_cart()
{
    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }
        WC_AJAX::get_refreshed_fragments();
    } else {
        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
        );
        echo wp_send_json($data);
    }
    wp_die();
}

//Function chạy giỏ hàng ajax
function woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;

    ob_start();

?>
    <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
        <p class="cart-number">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span id="count-it">
                <?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?>
            </span>
        </p>
        <span>Giỏ hàng</span>
    </a>
<?php

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}

// function tao_taxonomy()
// {
//     $labels = array(
//         'name' => 'Loại sản phẩm',
//         'singular' => 'Loại sản phẩm',
//         'menu_name' => 'Loại sản phẩm'
//     );

//     $args = array(
//         'labels' => $labels,
//         'hierarchical' => true,
//         'public' => true,
//         'show_ui' => true,
//         'show_admin_column' => true,
//         'show_in_nav_menus' => true,
//         'show_tagcloud' => true,
//     );

//     register_taxonomy('loai-san-pham', 'product', $args);
// }

// add_action('init', 'tao_taxonomy', 0);

//custom quantity

add_action('wp_footer', 'custom_quantity_fields_script');
function custom_quantity_fields_script()
{
?>
    <script type='text/javascript'>
        jQuery(function($) {
            if (!String.prototype.getDecimals) {
                String.prototype.getDecimals = function() {
                    var num = this,
                        match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                    if (!match) {
                        return 0;
                    }
                    return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
                }
            }
            // Quantity "plus" and "minus" buttons
            $(document.body).on('click', '.plus, .minus', function() {
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');

                // Format values
                if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
                if (max === '' || max === 'NaN') max = '';
                if (min === '' || min === 'NaN') min = 0;
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

                // Change the value
                if ($(this).is('.plus')) {
                    if (max && (currentVal >= max)) {
                        $qty.val(max);
                    } else {
                        $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                    }
                } else {
                    if (min && (currentVal <= min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                    }
                }

                // Trigger change event
                $qty.trigger('change');
            });
        });
    </script>
<?php
}
