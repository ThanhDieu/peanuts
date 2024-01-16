<?php
get_header();
$cats  = get_the_category();
get_template_part('sections/title-main');
?>

<section class="bg-img mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="position-relative w-100 sg-image image-cover bg-opacity bg-opacity-05">
                    <?php if (get_the_post_thumbnail_url()) : ?>
                    <?php the_post_thumbnail(); ?>
                    <?php else : ?>
                    <img loading=“lazy” src="<?php echo THEME_URL . '/images/no-image.jpg' ?>" alt="no image">
                    <?php endif; ?>
                    <p class="border-start sub-title line-row text-white px-5 my-5 position-absolute zindex">
                        <?php echo get_the_excerpt() ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="single-page page-section pt-8rem  ">
    <div class="container">
        <div class="row border-bottom pb-8rem">
            <div class="col-lg-9 col-12">
                <h1 class="text-uppercase font-alove  fs-40"><?php the_title() ?></h1>

                <div class="d-flex justify-content-between my-5">
                    <div class="d-flex align-items-center fs-12 light color-grey-7 flex-wrap">
                        <p class="it-date mb-0">
                            <?php echo get_the_date("d, M Y"); ?>
                        </p>
                        <span class="px-2"><?php echo $cats ? '|' : null; ?></span>
                        <div class="position-relative zindex">
                            <?php
                            $i = 1;
                            foreach ($cats as $cat) {
                                echo $i > 1 ? ", " : null;
                            ?>
                            <a href="<?php echo get_category_link($cat->term_id) ?>"
                                class="a-hover d-inline-block color-grey-7">
                                <?php echo $cat->name; ?>
                            </a>
                            <?php $i++;
                            } ?>
                        </div>
                    </div>
                    <ul class="social-share d-flex list-none mb-0 p-0">
                        <li>
                            <a class="d-inline-block ms-2 mr-2"
                                href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                                target="_blank">
                                <img width="100%" src="<?php echo THEME_URL . '/images/facebook-share-button.svg'; ?>"
                                    alt="Facebook" title="Facebook ">
                            </a>
                        </li>
                        <li>
                            <a class="d-inline-block ms-2 mr-2"
                                href="https://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php the_permalink(); ?>"
                                target="_blank">
                                <img width="100%" src="<?php echo THEME_URL . '/images/twitter-share-button.svg'; ?>"
                                    alt="Twitter" title="Twitter">
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="content pt-60 futura-light-font wow animate__fadeInUp">
                    <?php while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    wp_reset_query(); ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="ps-lg-5">
                    <?php get_template_part('sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
get_template_part('sections/last-news-main');
get_footer(); ?>