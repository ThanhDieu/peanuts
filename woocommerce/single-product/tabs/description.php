<?php

/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined('ABSPATH') || exit;

global $post;

$heading = apply_filters('woocommerce_product_description_heading', __('Mô tả sản phẩm', 'woocommerce'));

?>
<div class="row">
    <div class="col-md-5 col-12 ab-image">
        <figure class="w-8 image-cover m-auto">
            <?php $ffImg = get_field('ffpd_image', get_the_ID());
            if ($ffImg) : ?>
            <img loading=“lazy” src="<?php echo $ffImg['url']; ?>" alt="<?php echo $ffImg['title']; ?>">
            <?php else : ?>
            <img loading="lazy" src="<?php echo get_the_post_thumbnail_url()  ?>" alt="<?php the_title() ?>">
            <?php endif; ?>
        </figure>
    </div>
    <div class="col-md-7 col-12">
        <div class="w-9 ">
            <h2 class="bold fs-16 title-after d-inline-block mb-3"><?php echo esc_html($heading); ?></h2>
            <div>
                <?php the_content(); ?>
            </div>
        </div>
    </div>

</div>