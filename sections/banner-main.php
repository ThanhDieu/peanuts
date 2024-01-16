<section id="banner-main" class="banner-main u-mb-60 bg-img position-relative bg-08">
    <div class="owl-carousel owl-theme banner-slide">
        <?php
        if (have_rows('bn_list', get_the_ID())) :

            // Loop through rows.
            while (have_rows('bn_list', get_the_ID())) :
                the_row();
                $video = get_sub_field('video');
                $videoLink = $video['link_video'];
                if ($videoLink) preg_match('/src="(.+?)"/', $videoLink, $matches);
                $src = isset($matches) ? $matches[1] : '';
                $videoImg = $video['avatar'];
                $contentImg = get_sub_field('image_content');
                $img = $contentImg['image'];
        ?>
                <div class="item pt-8rem pb-8rem bg-img " style="background-image: url('<?php echo $videoImg ? $videoImg['url'] : $img['url'] ?>');">
                    <?php if ($videoLink) : ?>
                        <a class="d-flex h-100 align-items-center justify-content-center " href="#videoModal" role="button" onclick="videoPopup('<?php echo $src ?>')">
                            <img class="w-1" src="<?php echo THEME_URL . '/images/play-177.svg' ?>" alt="play">
                        </a>
                    <?php else : ?>
                        <div class="container pt-5 pb-60">
                            <div class="row pb-60">
                                <div class="col-lg-5 col-md-7 col-12">
                                    <div class="bg-main px-5 text-white">
                                        <h2 class="font-bd-thin fs-20 ">
                                            <?php echo $contentImg['title_1'] ?>
                                        </h2>
                                        <h1 class="font-alove fs-27 my-3    ">
                                            <?php echo $contentImg['title_2'] ?>
                                        </h1>
                                        <div class="fs-12">
                                            <?php echo $contentImg['text'] ?>
                                        </div>
                                        <?php $bn = $contentImg['link'] ?>
                                        <a href="<?php echo $bn['url'] ?? ''; ?>" class="font-alove mb-4 bg-img-link color-main d-inline-flex fs-16 px-5 u-pt-20 u-pb-15 text-text-uppercase justify-content-center btn-hover ">
                                            <?php echo $bn['title'] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>


        <?php endwhile;
            wp_reset_query();
        endif;
        ?>


    </div>
    <a href="javascript:void(0);" class="hero-control-play position-absolute play d-inline-flex align-items-center color-main bold" role="button">
        <i class="fa fa-pause" aria-hidden="true"></i>
        <span class="px-2">/</span>
        <i class="fa fa-play" aria-hidden="true"></i>
    </a>
    <div class=" wave position-absolute zindex"><img class="w-100" src="<?php echo THEME_URL . '/images/wave.svg' ?>" alt="wave"></div>
</section>
<!-- Modal -->
<div class="modal fade video-modal" id="videoModal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-header border-0">
                <button type="button" onclick="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <?php get_template_part('images/close'); ?>
                </button>
            </div>
            <div class="modal-body d-inline-flex"></div>
        </div>
    </div>
</div>