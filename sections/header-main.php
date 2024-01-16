<?php $actual_link = get_permalink(get_the_ID()); ?>
<header id="header-main" class="top-header bg-gray">
    <div class="container">
        <div class="position-relative pr-5 d-flex justify-content-end hd-lang-outer">
            <ul class="d-flex list-none mb-0 align-items-center flex-wrap">
                <li class="px-4 d-md-block d-none">
                    <?php $contact = get_field('hd_contact', 'option');
                    ?>
                    <a class=" d-inline-flex m-0 text-uppercase color-main bold fs-16 btn-hover"
                        href="<?php echo $contact['url'] ?? ''; ?>">
                        <?php echo $contact['title'] ?>
                    </a>
                </li>
                <li class="px-4">
                    <?php if (have_rows('hd_social', 'option')) : ?>
                    <ul class="social-links d-flex list-none mb-0 ps-0">
                        <?php while (have_rows('hd_social', 'option')) :
                                the_row();
                            ?>
                        <li class="text-uppercase">
                            <a class="color-main fs-22 px-2 btn-hover" href="<?php echo get_sub_field('link') ?>"
                                title="<?php echo get_sub_field('title'); ?>"
                                target="blank"><?php echo get_sub_field('icon'); ?></a>
                        </li>
                        <?php endwhile;
                            wp_reset_query(); ?>
                    </ul>
                    <?php endif; ?>
                </li>
                <li class="px-4  d-md-block d-none">
                    <?php $contact = get_field('hd_contact', 'option'); ?>
                    <a tabindex="0" class="d-inline-flex p-2 border-main m-0 popover-dismiss" role="button"
                        data-bs-toggle="popover"
                        data-bs-title='<span class="fs-16 text-white text-uppercase">Chia sẻ</span>' data-bs-content='
                            <div class="pp-outer p-3">
                                <h4>Bạn muốn chia sẻ? </h4>
                                <div class="p-2 position-relative">
                                    <input type="text" id="pageID" class="w-100 form-control fs-14"
                                        value="<?php echo $actual_link; ?>" readonly>
                                    <div title="Sao chép đường dẫn" class="position-absolute btn-copy"
                                        onclick="copyText(`<?php echo $actual_link; ?>`, `pageID`, `txtCopy`)">
                                        <i class="fa fa-clone fs-16 " aria-hidden="true"></i>
                                    </div>
                                    <span id="txtCopy"
                                        class="position-absolute txt-tooltip text-white fs-12 px-2">Đã sao
                                        chép</span>
                                </div>

                                <ul class="d-flex list-none ps-0 fs-18 mb-0 justify-content-center mt-3">
                                    <li>
                                        <a class="btn-social-icon btn-facebook text-white"
                                            href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link; ?>"
                                            target="_blank">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn-social-icon btn-twitter text-white"
                                            href="https://twitter.com/home?status=<?php echo $actual_link; ?>"
                                            target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a class="btn-social-icon btn-linkedin text-white"
                                            href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $actual_link; ?>&title=<?php echo get_the_title(get_the_ID()); ?>&source=example.com"
                                            target="_blank"> <i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a class="btn-social-icon btn-pinterest text-white"
                                            href="https://www.pinterest.com/pin/create/link/?url=<?php echo $actual_link; ?>&media=<?php echo the_post_thumbnail_url('large'); ?>&description=<?php echo get_the_title(get_the_ID()); ?>"
                                            target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                    </li>

                                </ul>
                            </div>
                           
                            '>

                        <?php get_template_part('images/share') ?>
                    </a>

                </li>
                <li class="ps-4">
                    <div class="hd-lang">
                        <a class="d-inline-flex align-items-center m-0 p-2 border-main" data-bs-toggle="modal"
                            rel="nofollow" role="button" href="#localizationModal">
                            <?php get_template_part('images/global') ?>
                            <span class="ps-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="8" viewBox="0 0 11 8">
                                    <path id="Polygon_1" data-name="Polygon 1" d="M5.5,0,11,8H0Z"
                                        transform="translate(11 8) rotate(180)" fill="#584040" />
                                </svg>
                            </span>

                        </a>
                    </div>
                </li>
            </ul>



        </div>
    </div>
</header>