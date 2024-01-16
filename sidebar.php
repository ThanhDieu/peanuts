<div class="sidebar-outer mb-5 bg-08 pb-5">
    <h2 class="text-white fs-20 medium pHa-20 pt-5 pb-3">
        DANH MỤC TIN TỨC
    </h2>
    <ul class="list-none ps-0 mb-0">
        <?php $cats = get_categories();
        foreach ($cats as $key => $cat) : ?>
            <li class="px-4 text-capitalize">
                <a href="<?php echo get_category_link($cat->term_id) ?>" class="text-white medium p-3 d-inline-block w-100 a-hover border-bottom">
                    <?php echo $cat->name ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="sidebar-outer bg-08 pb-4">
    <h2 class="text-white fs-20 medium pHa-20 pt-5 pb-3">
        BÀI VIẾT NỔI BẬT
    </h2>
    <div class="h-scroll-mb">
        <ul class="post-categories list-none ps-0 mb-0 pt-3">
            <?php
            $query = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'DESC',
                'post__in'  => get_option('sticky_posts'),
            ]);
            while ($query->have_posts()) : $query->the_post()
            ?>
                <li class="mb-4 px-4">
                    <a class="text-white d-inline-flex w-100 image-scale" href="<?php the_permalink() ?>">
                        <p class="image-cover radius-5 overflow-hidden image-holder mb-0 w-33">
                            <?php if (get_the_post_thumbnail_url()) : ?>
                                <?php the_post_thumbnail(); ?>
                            <?php else : ?>
                                <img loading=“lazy” src="<?php echo THEME_URL . '/images/no-image.jpg' ?>" alt="no image">
                            <?php endif; ?>
                        </p>
                        <div class="text-holder ps-4 w-66 pt-3">
                            <h4 class="it-title medium mb-0 line-row a-hover text-capitalize">
                                <?php echo get_the_title(); ?>
                            </h4>
                            <p class="it-date fs-12 light mb-0">
                                <?php echo get_the_date("d, M Y") ?>
                            </p>
                        </div>
                    </a>
                </li>
            <?php endwhile;
            wp_reset_query(); ?>
        </ul>
    </div>
</div>