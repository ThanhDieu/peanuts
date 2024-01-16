<section class="cats-main">
    <?php
    if (have_rows('cat_list', get_the_ID())) :
        $index = 0;
        while (have_rows('cat_list', get_the_ID())) : the_row();
            $name = get_sub_field('name');
            $img = get_sub_field('image');
            $link = get_sub_field('link');
    ?>
            <div class="cat-main u-mt-40  <?php echo $index % 2 == 0 ? 'bg-img-h-red' : 'bg-img-h-white'  ?>">
                <div class="row py-5 <?php echo $index % 2 == 1 ? 'flex-row-reverse' : ''  ?>">
                    <div class="col-lg-7 col-12">
                        <a href="<?php echo $link['url'] ?? '' ?>" class="d-inline-flex w-100 btn-hover">
                            <figure class="w-100 bg-img-h-yellow-sm d-flex justify-content-center">
                                <?php
                                if (!empty($img)) : ?>
                                    <img loading=“lazy” src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['title']); ?>" />
                                <?php endif; ?>
                            </figure>
                        </a>
                    </div>
                    <div class="col-lg-5 col-12 d-flex align-items-center justify-content-center pb-lg-0 pb-5">
                        <a href="<?php echo $link['url'] ?? '' ?>" class="d-inline-flex btn-hover ">
                            <h3 class="fs-50 font-alove <?php echo $index % 2 == 0 ? 'color-yellow' : 'color-main'  ?> ">
                                <?php echo $name ?></h3>

                        </a>
                    </div>
                </div>

            </div>

    <?php
            $index++;
        endwhile;

    endif; ?>
</section>