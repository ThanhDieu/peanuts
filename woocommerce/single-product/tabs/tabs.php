<?php

/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$dt = get_field('dtpd_content', get_the_ID());
$dtGroup = get_field('dtpd_group', get_the_ID());
$dtpdNutrition = get_field('dtpd_nutrition', get_the_ID());
$dtpdNutritionObj = get_field_object('dtpd_nutrition', get_the_ID());
$dtImg = get_field('dtpd_image', get_the_ID());
?>

<div class="content-detail position-relative">
    <div class="container position-relative">
        <div class="top-detail box-shadow-6 bg-white py-5 px-4 mb-5 bd-radius-10">
            <?php woocommerce_product_description_tab(); ?>
        </div>
        <?php
        if ($dtGroup || $dt || $dtImg || $dtpdNutrition) :

        ?>
        <div class="bot-detail box-shadow-6 bg-white py-5 px-4 mb-5 bd-radius-10">
            <div class="row ">
                <div class="col-md-7 col-12 d-flex justify-content-end">
                    <div class="w-9">
                        <?php if ($dtGroup) :
                                $dtpdGroupObj = get_field_object('dtpd_group', get_the_ID());
                                $subGroupObj = $dtpdGroupObj['sub_fields'];
                                for ($i = 1; $i < 4; $i++) {
                                    $name = 'item_' . $i;
                                    $field = $dtGroup[$name];
                                    $fieldObject = $subGroupObj[$i - 1];
                            ?>

                        <h2 class="bold fs-16 title-after d-inline-block mb-3">
                            <?php echo $fieldObject['label']; ?>
                        </h2>
                        <div>
                            <?php echo $field; ?>
                        </div>
                        <?php
                                }
                            endif;
                            if ($dt) :
                                while (have_rows('dtpd_content', get_the_ID())) : the_row();
                                ?>
                        <h2 class="bold fs-16 title-after d-inline-block mb-3">
                            <?php echo get_sub_field('title', get_the_ID()) ?></h2>
                        <div>
                            <?php echo get_sub_field('text', get_the_ID())  ?>
                        </div>
                        <?php
                                endwhile;
                                wp_reset_query();
                            endif;
                            ?>
                    </div>

                </div>
                <div class="col-md-5 col-12 bg-img-dtgr">
                    <?php if ($dtImg) : ?>
                    <figure class="w-8 image-cover m-auto">
                        <img loading=“lazy” src="<?php echo $dtImg['url']; ?>" alt="<?php echo $dtImg['title']; ?>">
                    </figure>

                    <?php elseif ($dtpdNutrition) :
                            $subFieldsObj = $dtpdNutritionObj['sub_fields'];
                        ?>
                    <div class="w-9 m-auto">
                        <h3 class="color-main text-center font-alove mb-3 fs-20">Thông tin dinh dưỡng</h3>
                        <table class="table table-hover table-warning table-striped align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle">Thành phần dinh dưỡng</th>
                                    <th scope="col" class="align-middle text-center">Trên 100g</th>
                                    <th scope="col" class="align-middle text-center">% giá trị dinh dưỡng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        for ($i = 1; $i < 8; $i++) {
                                            $name = 'row_' . $i;
                                            $field = $dtpdNutrition[$name];
                                            $fieldObject = $subFieldsObj[$i - 1];
                                            if ($field['show'] == 1) {
                                        ?>
                                <tr class="<?php echo ($i == 7) ? 'border-bottom' : ''; ?>">
                                    <td class="<?php echo ($i == 4 || $i == 6) ? 'ps-4' : ''; ?>">
                                        <?php echo $fieldObject['label']; ?></td>
                                    <td class="text-center"><?php echo $field['value']; ?></td>
                                    <td class="text-center"><?php echo $field['percent']; ?></td>
                                </tr>
                                <?php  }
                                        }
                                        if ($dtpdNutrition['other']) :
                                            foreach ($dtpdNutrition['other'] as $other) : ?>
                                <tr>
                                    <td><?php echo $other['name']; ?></td>
                                    <td class="text-center"><?php echo $other['value']; ?></td>
                                    <td class="text-center"><?php echo $other['percent']; ?></td>
                                </tr>
                                <?php endforeach;
                                        endif; ?>
                                <tr class="fs-12 ">
                                    <td colspan="3">
                                        <span class="color-main">*</span>
                                        <?php echo $dtpdNutrition['note']; ?>
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                    <?php endif;
                        wp_reset_query(); ?>
                </div>


            </div>
        </div>
        <?php endif; ?>
    </div>
</div>