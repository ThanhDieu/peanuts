<section class="instagram-main py-5">
    <div class="container">
        <h2 class="title fs-34 text-uppercase font-alove text-center title-after ">
            <?php echo get_field('ins_title', 'option') ?>
        </h2>
        <div class="py-5">
            <?php echo do_shortcode(get_field('ins_code', 'option')) ?>
        </div>

    </div>

</section>
<section class="news-letter-main py-5 d-flex align-items-center">
    <div class="container ">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12 pe-5 d-lg-block d-none ">
                <figure class="mb-0 image-cover w-100 news-left">
                    <?php $imgNewsLeft = get_field('news_left', 'option') ?>
                    <img loading=“lazy” src="<?php echo $imgNewsLeft['url']  ?? ''; ?>"
                        alt="<?php echo $imgNewsLeft['title'] ?? ''; ?>">
                </figure>
            </div>
            <div class="col-lg-5 col-md-8 col-12 ">

                <h2 class="text-capitalize text-uppercase font-alove fs-40 d-flex align-items-center">
                    <span class="me-3 pb-3"><?php echo get_field('news_title', 'option') ?></span>
                    <img width="42" src="<?php echo THEME_URL . '/images/letter.svg' ?>" alt="letter">

                </h2>
                <p class="fs-15"> <?php echo get_field('news_text', 'option') ?></p>

                <?php echo do_shortcode('[gravityform id=1 title=false description=false ajax=true tabindex=49]') ?>

            </div>
            <div class="col-lg-3 col-md-4 col-12 position-relative">
                <figure class="mb-0 image-cover news-right position-absolute">
                    <?php $imgNewsRight = get_field('news_right', 'option') ?>
                    <img loading=“lazy” src="<?php echo $imgNewsRight['url'] ?>"
                        alt="<?php echo $imgNewsRight['title'] ?>">
                </figure>
            </div>
        </div>

    </div>
</section>
<section class="social-main py-3">
    <div class="container title-after">
        <div class="d-flex justify-content-center flex-wrap">
            <h2 class="title text-uppercase font-alove fs-34 text-center  ">
                <?php echo get_field('social_title', 'option') ?>
            </h2>
            <?php if (have_rows('hd_social', 'option')) : ?>
            <ul class="d-flex list-none mb-0 ">
                <?php while (have_rows('hd_social', 'option')) : the_row();
                    ?>
                <li class="text-uppercase">
                    <a class="color-main fs-30 px-2 a-hover" href="<?php echo get_sub_field('link') ?>"
                        title="<?php echo get_sub_field('title'); ?>"
                        target="blank"><?php echo get_sub_field('icon'); ?></a>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>

</section>