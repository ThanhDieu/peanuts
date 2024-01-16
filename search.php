<?php
get_header();
global $wp_query;
$s = get_search_query(); ?>
<section class="page-title first-main">
    <div class="container">
        <div class="row">
            <div class="col-12 border-bottom py-5">
                <div class="page-title-content">
                    <h1 class="text-black fs-30 bold">
                        Tìm kiếm: <?php echo $s; ?>
                    </h1>
                    <span class="sub-title"><?php echo 'Kết quả: ' . $wp_query->found_posts; ?></span>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="blog-content pt-60 pb-60 blog-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <ul class="row list-none ps-0">
                    <?php
                    $args      = array(
                        's' => $s
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {

                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                            $permalink = get_permalink($post->ID);
                            $title     = get_the_title($post->ID->ID);
                            $except    = get_the_excerpt($post->ID->ID);
                            $img       = get_the_post_thumbnail($post->ID->ID);
                    ?>
                            <div class="col-md-4 col-6 mb-5">
                                <a href="<?php echo $permalink; ?>" class="post-item image-scale color-grey-7">
                                    <p class="image-cover mb-5 h-240 bg-opacity position-relative">
                                        <?php
                                        if ($img) {
                                            echo $img;
                                        } else { ?>
                                            <img loading=“lazy” src="<?php echo THEME_URL . '/images/no-image.jpg' ?>" alt="no image">
                                        <?php } ?>
                                    </p>
                                    <h4 class="bold fs-18 pb-4 text-black mb-0"><?php echo $title; ?></h4>
                                    <div class="line-row light">
                                        <?php echo $except ?>
                                    </div>
                                </a>
                            </div>
                        <?php
                        } ?>
                    <?php
                    } else {
                    ?>
                        <p class="bold fs-20">Không tìm thấy kết quả</p>
                        <p>Rất xin lỗi, nhưng không có nội dung nào phù hợp với yêu cầu tìm kiếm của bạn. Vui
                            lòng
                            thử
                            lại với một số từ khóa khác nhau.</p>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-3 col-12">
                <?php get_template_part('sidebar'); ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer()
?>