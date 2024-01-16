<?php
get_header();
$cat = get_queried_object();

$pdcBanner = get_field('pdc_banner', $cat);
$dfBanner = THEME_URL . '/images/25.jpg';
$pdTitle = get_field('pdc_title', $cat);
get_template_part('sections/title-main');
?>


<section class="product-cat-banner bg-img mt-5 d-flex align-items-lg-end" style="background-image: url('<?php echo $pdcBanner ?? $dfBanner; ?>');">
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

<section class="page-title first-main">
    <div class="container">
        <div class="row">
            <div class="col-12 py-5">
                <div class="page-title-content">
                    <h1 class=" text-uppercase fs-50 font-bd-bold text-center">
                        <?php echo $cat->name; ?>
                    </h1>
                    <span class="sub-title"><?php echo $cat->description; ?></span>
                </div>
            </div>

        </div>
    </div>
</section>
<div id="news-page" class="content-outer position-relative overflow-hidden pt-5 pb-5 blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12 d-flex align-content-between flex-wrap">
                <ul class="list-none ps-0">
                    <?php
                    $id    = get_queried_object_id();
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $list  = new WP_Query([
                        'post_type'      => 'post',
                        'posts_per_page' => 4,
                        'paged'          => $paged,
                        'cat'            => $id
                    ]);
                    while ($list->have_posts()) : $list->the_post()
                    ?>
                        <li class="image-scale d-flex item-post mb-5 flex-wrap">
                            <figure class="mb-0 image-cover w-33 radius-5">
                                <?php if (get_the_post_thumbnail_url()) : ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else : ?>
                                    <img loading=“lazy” src="<?php echo THEME_URL . '/images/no-image.jpg' ?>" alt="no image">
                                <?php endif; ?>
                            </figure>
                            <div class="text-holder w-66 p-5 position-relative">
                                <div class="d-flex align-items-center fs-12 light mb-3 color-grey-7 flex-wrap">
                                    <p class="it-date mb-0">
                                        <?php echo get_the_date("d, M Y"); ?>
                                    </p>
                                    <?php $cats = get_the_category(); ?>
                                    <span class="px-2"><?php echo $cats ? '|' : null; ?></span>
                                    <div class="position-relative zindex">
                                        <?php
                                        $i = 1;
                                        foreach ($cats as $cat) {
                                            echo $i > 1 ? ", " : null;
                                        ?>
                                            <a href="<?php echo get_category_link($cat->term_id) ?>" class="a-hover d-inline-block color-grey-7">
                                                <?php echo $cat->name; ?>
                                            </a>
                                        <?php $i++;
                                        } ?>
                                    </div>
                                </div>
                                <h3 class="bold fs-20 line-row mb-0 text-black text-capitalize">
                                    <?php echo get_the_title(); ?>
                                </h3>
                                <p class="line-row line-row-3 mt-3">
                                    <?php echo get_the_excerpt() ?>
                                </p>
                                <a href="<?php the_permalink() ?>" class="font-alove mb-4 bg-img-link color-main d-inline-flex fs-16 px-5 u-pt-20 u-pb-15 text-text-uppercase justify-content-center btn-hover ">Xem
                                    chi tiết</a>
                            </div>
                        </li>
                    <?php endwhile;
                    wp_reset_query(); ?>
                </ul>
                <div class="pagenavi-page w-100 text-center pt-20">
                    <?php if (function_exists('devvn_wp_corenavi')) {
                        devvn_wp_corenavi($list);
                    } ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="ps-lg-5">
                    <?php get_template_part('sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>