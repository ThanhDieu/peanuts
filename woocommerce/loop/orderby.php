<?php

/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}
$current = isset($_GET['products_per_page']) ? $_GET['products_per_page'] : 12;
?>
<div class="top-products mt-md-5 mt-4 mb-5 fs-18">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="content-left">
            <form class="woocommerce-ordering d-flex align-items-center" method="get">
                <label for="ordering_per_page " class="bold fs-18 me-2"><?php _e('Sort by:', 'woocommerce'); ?></label>
                <select name="orderby" class="orderby" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>">
                    <?php foreach ($catalog_orderby_options as $id => $name) : ?>
                    <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>>
                        <?php echo esc_html($name); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="paged" value="1" />
                <?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
            </form>
        </div>
        <div class="content-right d-flex ">
            <div class="perpage-outer u-mr-60">
                <span class="bold fs-18"><?php _e('Hiển thị:', 'woocommerce'); ?></span>
                <a href="<?php echo esc_url(add_query_arg('products_per_page', '12')); ?>"
                    class="px-2 color-main <?php if ($current == '12') echo 'bold'; ?>">12</a>
                |
                <a href="<?php echo esc_url(add_query_arg('products_per_page', '24')); ?>"
                    class="px-2 color-main <?php if ($current == '24') echo 'bold'; ?>">24</a>
                |
                <a href="<?php echo esc_url(add_query_arg('products_per_page', '48')); ?>"
                    class="px-2 color-main <?php if ($current == '48') echo 'bold'; ?>">48</a>
            </div>
            <div class="view-outer d-flex align-items-center">
                <span class="bold fs-18"><?php _e('Chế độ xem:', 'woocommerce'); ?></span>
                <a href="<?php echo esc_url(add_query_arg('view_mode', 'grid')); ?>" class="px-2 "><i
                        class="fa fa-windows <?php echo (!isset($_GET['view_mode']) || $_GET['view_mode'] == 'grid') ? 'color-main bold' : 'color-red'; ?>"
                        aria-hidden="true"></i></a>
                <a href="<?php echo esc_url(add_query_arg('view_mode', 'list')); ?>" class="px-2 "><i
                        class="fa fa-list-ul <?php echo (isset($_GET['view_mode']) && $_GET['view_mode'] == 'list') ? 'color-main bold' : 'color-red'; ?>"
                        aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</div>