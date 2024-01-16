<footer id="footer" class="footer-main pt-8rem pb-5 ">
    <div class="footer-top bg-red-blue py-5 text-white pb-8rem">
        <div class="container pb-60">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-12 first-col">
                    <h3 class="text-capitalize text-white fs-18">
                        <?php echo get_field('ft_title', 'option') ?>
                    </h3>

                    <div class="pe-5">
                        <?php echo get_field('ft_text', 'option') ?>
                    </div>
                    <?php $linkMore = get_field('ft_link', 'option') ?>
                    <a href="<?php echo $linkMore['url'] ?>" class="text-white a-hover">
                        <i class="fa fa-caret-right pe-3"></i>
                        Xem thêm</a>
                </div>
                <?php if (have_rows('ft2_list', 'option')) :
                ?>

                    <div class="col-lg-2 col-md-6 col-12">
                        <?php while (have_rows('ft2_list', 'option')) :
                            the_row();
                            $pages = get_sub_field('pages', 'option'); ?>
                            <div class="mb-4">
                                <h3 class="text-capitalize text-white fs-18">
                                    <?php echo get_sub_field('title', 'option') ?>
                                </h3>
                                <?php if ($pages) : ?>
                                    <ul class="list-none ps-0 mb-4">
                                        <?php foreach ($pages as $page) :
                                            $subLink = $page['link'];
                                            if ($subLink) :
                                        ?>
                                                <li class="pl-3 pr-3">
                                                    <a href="<?php echo $subLink['url']  ?? ''; ?>" class="py-1 text-white d-inline-block a-hover">
                                                        <?php echo $subLink['title']; ?>
                                                    </a>
                                                </li>
                                        <?php endif;
                                        endforeach; ?>
                                    </ul>
                            </div>
                    <?php endif;
                            endwhile;
                            wp_reset_query(); ?>
                    </div>
                <?php endif; ?>
                <div class="col-lg-2 col-md-6 col-12">
                    <h3 class="text-capitalize text-white fs-18">
                        <?php echo get_field('ft3_title', 'option') ?>
                    </h3>
                    <?php if (have_rows('ft3_list', 'option')) : ?>
                        <ul class="list-none ps-0">
                            <?php while (have_rows('ft3_list', 'option')) :
                                the_row();
                            ?>
                                <?php $link = get_sub_field('link');
                                if ($link) : ?>
                                    <li class="pl-3 pr-3">
                                        <a href="<?php echo $link['url']  ?? ''; ?>" class="py-1 text-white d-inline-block a-hover">
                                            <?php echo $link['title']; ?>
                                        </a>
                                    </li>
                            <?php endif;
                            endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <h3 class="text-capitalize text-white fs-18 ">
                        <?php echo get_field('ft4_title', 'option') ?>
                    </h3>
                    <p>
                        <?php echo get_field('ft4_text', 'option') ?>
                    </p>
                    <?php $ft3 = get_field('ft4_link', 'option') ?>
                    <a href="<?php echo $ft3['url']  ?? ''; ?>" class="cus-button color-main bg-img-button btn-hover"><?php echo $ft3['title'] ?></a>
                </div>

            </div>

        </div>
    </div>

    <div class="footer-bottom position-relative pt-4">
        <a href="<?php echo home_url('/') ?>" class="ft-logo position-absolute d-inline-block">
            <?php $logoF = get_field('logo_main', 'option'); ?>
            <img loading=“lazy” src="<?php echo $logoF['url']  ?? ''; ?>" alt="<?php echo $logoF['title'] ?>">
        </a>
        <div class="container text-center pt-8rem">
            <p class="pt-5 mb-0">
                <?php the_field('copyright', 'option'); ?>
            </p>
            <p id="clockPT"></p>
        </div>
    </div>

    <ul id="bannerGlobal" class="fixed-bottom list-none ps-0">
        <?php $contact = get_field('hd_contact', 'option');
        ?>
        <li data-bs-toggle="tooltip" data-bs-placement="left" title="<?php echo $contact['title'] ?>">

            <a class=" d-inline-flex m-0 justify-content-center w-100 p-3 color-main fs-20 btn-hover" href="<?php echo $contact['url']  ?? ''; ?>">
                <i class="fa fa-headphones" aria-hidden="true"></i>

            </a>
        </li>
        <li data-bs-toggle="tooltip" data-bs-placement="left" title="Chia sẻ">
            <?php $actual_link = get_permalink(get_the_ID()); ?>
            <a tabindex="0" title="Chia sẻ" class="d-inline-flex m-0 justify-content-center w-100 p-3 color-main fs-20 btn-hover popover-dismiss" role="button" data-bs-toggle="popover" data-bs-title='<span class="fs-16 text-white text-uppercase">Chia sẻ</span>' data-bs-content='
                            <div class="pp-outer p-3">
                                <h4>Bạn muốn chia sẻ? </h4>
                                <div class="p-2 position-relative">
                                    <input type="text" id="pageID1" class="w-100 form-control fs-14"
                                        value="<?php echo $actual_link; ?>" readonly>
                                    <div title="Sao chép đường dẫn" class="position-absolute btn-copy"
                                        onclick="copyText(`<?php echo $actual_link; ?>`, `pageID1`, `txtCopy1`)">
                                        <i class="fa fa-clone fs-16 " aria-hidden="true"></i>
                                    </div>
                                    <span id="txtCopy1"
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

                <i class="fa fa-share-square-o" aria-hidden="true"></i>
            </a>

        </li>
        <li data-bs-toggle="tooltip" data-bs-placement="left" title="Về đầu trang" class="go-to-top">
            <a id="backToTop" class=" d-inline-flex m-0 justify-content-center w-100 p-3 color-main fs-20 btn-hover" title="Go to top" href="function: void(0)">
                <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
            </a>
        </li>
    </ul>

    <div class="modal fade" id="localizationModal" tabindex="-1" aria-labelledby="localizationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <h3 class="text-black text-center ">Please select your language</h3>
                    <p class="text-center light mb-5"><small>
                            To view website content in your language, please select an option below.</small></p>
                    <ul class="localization-modal-list list-none pe-0 d-flex justify-content-center mb-0">
                        <li class="mb-3">
                            <a class="bg-main fs-14 medium d-inline-flex px-4 py-2 text-white" href="<?php echo get_page_link() ?>">Việt Nam</a>
                        </li>
                    </ul>

                    <!-- GOOGLE TRANSLATE -->
                    <div class="translatepos text-center mt-5">
                        <p class="clearfix nomarg">
                            <span id="google_translate_element" class="common input-sm" />
                        </p>
                    </div>
                    <style>
                        .goog-te-banner-frame.skiptranslate {
                            display: none;
                            height: 0;
                        }
                    </style>
                    <!-- / GOOGLE TRANSLATE -->

                </div>
            </div>

        </div>
    </div>


    <!-- /** script */ -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'vi'
                },
                'google_translate_element'
            );
        }
    </script>

    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <?php wp_footer() ?>
</footer>
</body>

</html>