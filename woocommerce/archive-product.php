<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 0);
do_action('woocommerce_before_main_content');
get_template_part('sections/title-main');

// get the current taxonomy term
$term = get_queried_object();

// vars
$pdcBanner = get_field('pdc_banner', $term);
$dfBanner = THEME_URL . '/images/25.jpg';
$pdTitle = get_field('pdc_title', $term);
?>

<section class="product-cat-banner bg-img mt-5 d-flex align-items-lg-end"
    style="background-image: url('<?php echo !empty($pdcBanner) ? $pdcBanner : $dfBanner; ?>');">
    <?php if ($pdTitle) : ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-8">
                <div class="bg-img-yellow bg-img u-pt-50 u-pb-50 u-pr-50 u-pl-50">
                    <h2 class="font-alove fs-50 line-row line-row-4"><?php echo get_field('pdc_title', $term); ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>

<section class="woocommerce-products-header mt-5">
    <div class="container">
        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
        <h1 class="woocommerce-products-header__title page-title text-uppercase fs-50 font-bd-bold text-center">
            <?php woocommerce_page_title(); ?></h1>
        <?php endif; ?>

        <?php
        do_action('woocommerce_archive_description');
        ?>
    </div>
</section>

<section id="archive-product-page">
    <div class="container">
        <?php
        if (woocommerce_product_loop()) {


            do_action('woocommerce_before_shop_loop');

            woocommerce_product_loop_start();
            if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();

                    do_action('woocommerce_shop_loop');
                    wc_get_template_part('content', 'product');
                }
            }

            woocommerce_product_loop_end();



            do_action('woocommerce_after_shop_loop');
        } else {
            do_action('woocommerce_no_products_found');
        }

        do_action('woocommerce_after_main_content'); ?>
    </div>
</section>

<?php

get_template_part('sections/news-letter-main');
get_footer('shop'); ?>