<?php

/**
 * Template Name: Giới thiệu
 */

get_header();

get_template_part('sections/title-main');
?>
<section class="ab-title mb-5 mt-4">
    <div class="container">
        <h1 class="text-uppercase font-alove text-center title-after fs-50"><?php the_title() ?></h1>
    </div>
</section>
<section class="ab-banner bg-main mb-5 text-white">
    <div class="container">
        <?php $banner = get_field('ab_bn_content', get_the_ID());
        $bnImg = $banner['image'];
        $bnTitle = $banner['title'];
        $bnTxt = $banner['text'];
        ?>
        <div class="row flex-md-row-reverse align-items-center">
            <div class="col-md-5 col-12">
                <figure class="image-cover ">
                    <img loading=“lazy” src="<?php echo $bnImg['url']; ?>" alt="<?php echo $bnImg['title']; ?>">
                </figure>
            </div>
            <div class="col-md-7 col-12 py-5">
                <div class="content">
                    <h2 class="fs-30 font-alove mb-4 ">
                        <?php echo $bnTitle; ?>
                    </h2>
                    <div class="text fs-16">
                        <?php echo $bnTxt; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ab-list">
    <?php
    if (have_rows('ab_list_content', get_the_ID())) :
        $index = 0;
        while (have_rows('ab_list_content', get_the_ID())) : the_row();
            $name1 = get_sub_field('title_1');
            $name2 = get_sub_field('title_2');
            $img = get_sub_field('image');
            $text = get_sub_field('text');
            $videoAb = get_sub_field('video');
    ?>
    <div class="u-mt-40 box-shadow-6 u-pb-40 u-pt-40">
        <div class="container">
            <div class="row <?php echo $index % 2 == 1 ? 'flex-row-reverse' : ''  ?>">
                <div class="col-md-6 col-12 ab-image ">
                    <?php if (!empty($videoAb)) {
                                echo $videoAb;
                            } else { ?>
                    <figure class="image-cover w-100">
                        <?php if (!empty($videoAb)) {
                                        echo $videoAb;
                                    } elseif (!empty($img)) { ?>
                        <img loading=“lazy” src="<?php echo esc_url($img['url']); ?>"
                            alt="<?php echo esc_attr($img['title']); ?>" />
                        <?php } else {
                                    ?>
                        <img loading=“lazy” src="<?php echo THEME_URL . '/images/no-image.jpg' ?>"
                            alt="<?php echo esc_attr($name2); ?>" />
                        <?php
                                    }
                                } ?>
                    </figure>

                </div>
                <div class="col-md-6 col-12 d-flex pt-4 <?php echo $index % 2 == 1 ? 'pe-5' : 'ps-5'  ?>">
                    <div class="content">
                        <h2 class="fs-45 font-alove u-mb-20">
                            <?php echo $name1 ?></h2>
                        <div class="text fs-16 w-9">
                            <?php echo $text ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
            $index++;
        endwhile;

    endif; ?>
</section>



<?php
get_template_part('sections/news-letter-main');
get_footer();
?>