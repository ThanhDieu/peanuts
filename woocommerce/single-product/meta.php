<?php

/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;
$content = get_field('dtpd_content', get_the_ID());

$contentObj = get_field_object('dtpd_content', get_the_ID());
?>

<div class="product_meta border-top border-bottom pt-3">

    <?php do_action('woocommerce_product_meta_start'); ?>

    <?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) : ?>
    <!-- 
    <p class="sku_wrapper"><strong class="text-dark"><?php esc_html_e('SKU:', 'woocommerce'); ?></strong> <span
            class="sku text-black-50"><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></span>
    </p> -->

    <?php endif;
    if ($content) :
    ?>
    <ul class="list-none ps-0 mb-0">
        <?php
            $subContentObj = $contentObj['sub_fields'];
            for ($i = 1; $i < 6; $i++) {
                $name = 'info_' . $i;
                $field = $content[$name];
                $fieldObject = $subContentObj[$i - 1];
            ?>
        <li class="text-black-50 mb-2 d-flex">
            <p class="pe-3 text-dark w-25 mb-0"><strong><?php echo $fieldObject['label']; ?>:</strong></p>
            <?php echo $i == 2 && empty($field) ? (($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'))  : $field; ?>
        </li>
        <?php  } ?>
    </ul>

    <?php endif; ?>

    <!-- <?php echo wc_get_product_category_list($product->get_id(), ', ', '<p class="posted_in">' . _n('<strong class="text-dark">Danh mục:</strong>', 'Categories:', count($product->get_category_ids()), 'woocommerce') . ' ', '</p>'); ?>

    <?php echo wc_get_product_tag_list($product->get_id(), ', ', '<p class="tagged_as">' . _n('Tag:', 'Tags:', count($product->get_tag_ids()), 'woocommerce') . ' ', '</p>'); ?> -->

    <?php do_action('woocommerce_product_meta_end'); ?>

</div>


<div class="d-block">
    <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"
        class="cus-button color-main bg-img-button btn-hover">
        <span class="fs-20">Mua ngay</span></a>

    <div class="offcanvas offcanvas-start bg-F4F5" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="card border-0">
                <div class="card-header bg-main">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="#">MUA ONLINE</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <figure class="logo-online w-50 mb-0">
                                <img loading=“lazy” src="<?php echo THEME_URL . '/images/logo/shopee.svg' ?>"
                                    alt="shopee">
                            </figure>
                            <div class="">
                                <a href="<?php echo $pd_online['link_1']  ?? '#'; ?>"
                                    class="cus-button color-main bg-img-button btn-hover" target="_blank">mua ngay</a>
                            </div>
                        </li>
                        <?php if ($pd_online['link_2']) : ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <figure class="logo-online w-50 mb-0">
                                <img loading=“lazy” src="<?php echo THEME_URL . '/images/logo/lazada.png' ?>"
                                    alt="lazada">
                            </figure>
                            <div class="">
                                <a href="<?php echo $pd_online['link_2']  ?? ''; ?>"
                                    class="cus-button color-main bg-img-button btn-hover" target="_blank">Mua ngay</a>
                            </div>
                        </li>
                        <?php endif;
                        if ($pd_online['link_3']) : ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <figure class="logo-online w-50 mb-0">
                                <img loading=“lazy” src="<?php echo THEME_URL . '/images/logo/tiki.png' ?>" alt="tiki">
                            </figure>
                            <div class="">
                                <a href="<?php echo $pd_online['link_3']  ?? ''; ?>"
                                    class="cus-button color-main bg-img-button btn-hover" target="_blank">Mua ngay</a>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>