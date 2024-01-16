<?php
get_header();

get_template_part('sections/title-main');
?>
<section class="ab-title mb-5 mt-4">
    <div class="container">
        <h1 class="text-uppercase font-alove text-center title-after fs-50"><?php the_title() ?></h1>
    </div>
</section>
<section id="single-page" class="blog-page content-outer position-relative overflow-hidden pt-5 pb-5">

    <div class="container">
        <div class="row">
            <div class="content col-12 pb-5">
                <?php while (have_posts()) : the_post();
                    the_content();
                endwhile; ?>
            </div>
        </div>
    </div>
</section>


<?php
get_template_part('sections/news-letter-main');
get_footer();
?>