<?php

/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product;
?>
<p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>">
    <?php echo $product->get_price_html(); ?></p>
<?php if ($product->is_type('variable') && !empty($product->get_available_variations())) :
    $variations = $product->get_available_variations();
?>

    <div class="variation-select">
        <p class="mb-1 medium">
            <?php
            $variation_attributes = $variations[0];
            foreach ($variation_attributes['attributes'] as $name => $value) {
                $label = wc_attribute_label(str_replace('attribute_', '', $name));
                echo $label . " ";
            } ?>
        </p>
        <?php
        foreach ($variations as $name => $variation) : ?>
            <?php $variation_id = $variation['variation_id']; ?>
            <label class="ab-item">
                <input type="radio" name="variation_id" value="<?php echo $variation_id; ?>">
                <?php echo wc_get_formatted_variation($variation['attributes'], true, false); ?>
            </label>
        <?php endforeach; ?>
    </div>

    <script>
        jQuery(document).ready(function($) {
            var variations = <?php echo json_encode($variations); ?>;
            $('.variation-select input[type="radio"]').change(function() {
                $('.ab-item').removeClass('active');
                $(this).parent().addClass('active');
                var variation_id = $(this).val();
                for (var i = 0; i < variations.length; i++) {
                    if (variations[i].variation_id == variation_id) {
                        var price_html = '<p class="price">' + variations[i].price_html + '</p>';
                        $('.price').replaceWith(price_html);
                    }
                }
            });
        });
    </script>
<?php endif ?>