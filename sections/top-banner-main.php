<section id="top-banner-main" class="top-banner-main box-shadow-6 bg-img btn-hover"
    style="background-image: url('<?php the_field('bn_top_image', get_the_ID()); ?>');">
    <div class="container pt-60 pb-8rem">
        <div class="row pb-60">
            <?php $linkTbn = get_field('bn_top_link', get_the_ID()) ?>
            <div class="col-12">
                <a href="<?php echo $linkTbn['url'] ?? ''; ?>">
                    <div class="bg-img color-main button-link text">
                        <h3 class="font-alove"><?php the_field('bn_top_title_big', get_the_ID()) ?></h3>
                    </div>
                    <h2 class="font-alove fs-50 color-main my-4"><?php the_field('bn_top_title', get_the_ID()) ?></h2>

                </a>
            </div>
        </div>
    </div>
</section>