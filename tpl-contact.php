<?php

/**
 * Template Name: Liên hệ
 */

get_header();
get_template_part('sections/title-main');
?>


<section class="ab-title mb-5 mt-4">
    <div class="container text-center">
        <h1 class="text-uppercase font-alove  fs-40"><?php the_title() ?></h1>
        <p class="text fs-20"><?php echo get_field('page_summary', get_the_ID()) ?></p>
    </div>
</section>
<section id="contact" class="contact-page pb-8rem ">
    <div class="container">
        <div class="row ">
            <div class="col-lg-5 col-12">
                <div class="contact-info  p-3 w-100 text-white bg-red-blue ">
                    <div class="bg-img-peanut p-5">
                        <div class="mb-5">
                            <h2 class="fs-30 font-bd-bold mb-4"><?php echo get_field('ct_tile', get_the_ID()); ?></h2>
                            <p class="fs-16"><?php echo get_field('ct_text', get_the_ID()); ?></p>
                        </div>
                        <ul class="mb-5 list-none ps-0">
                            <?php
                            if (have_rows('info_list', get_the_ID())) :
                                while (have_rows('info_list', get_the_ID())) : the_row();
                            ?>
                            <li class="row fs-16 border-bottom">
                                <p class="col-md-1 mb-0 ">
                                    <?php echo get_sub_field('icon') ?>
                                </p>
                                <p class="col-md-11 mb-0 ">
                                    <?php echo get_sub_field('text') ?>
                                </p>
                            </li>
                            <?php
                                endwhile;
                                wp_reset_query();
                            endif;
                            ?>
                        </ul>
                        <div>
                            <h2 class="fs-30 font-bd-bold"><?php echo get_field('ct_chat_title', get_the_ID()); ?>
                            </h2>
                            <p class="fs-16"><?php echo get_field('ct_chat_text', get_the_ID()); ?></p>


                            <button class="cus-button color-main bg-img-button-white btn-hover border-0"
                                onclick="toggleChat()">
                                <span class="fs-20"><?php
                                                    $chat = get_field('ct_chat_btn', get_the_ID());
                                                    echo $chat['name']; ?></span>
                            </button>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-7 col-12 mt-lg-0 mt-5">
                <?php echo do_shortcode('[gravityform id=2 title=false description=false ajax=true tabindex=49]') ?>
            </div>

        </div>
    </div>
</section>

<?php
get_template_part('sections/news-letter-main');
get_footer();
?>