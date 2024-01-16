<!--Code Lấy bài Viết Của Taxonomy-->
<?php
$id = get_queried_object_id();
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$list = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => 3,
    'paged' => $paged,
    'tax_query' => array(
        'relation' => 'AND',
        array(
            'taxonomy' => 'taxonomy',
            'field' => 'id',
            'terms' => $id,
        )),
]);
while($list->have_posts()) : $list->the_post()
    ?>
<?php the_post_thumbnail() ?>
<?php echo get_the_title(); ?>
<?php echo get_the_excerpt() ?>
<a href="<?php the_permalink() ?>"></a>
<?php echo get_the_date() ?>
<?php echo get_the_time() ?>
<?php endwhile; wp_reset_query(); ?>
<div class="pagenavi">
    <?php if (function_exists('devvn_wp_corenavi')) devvn_wp_corenavi($query); ?>
</div>