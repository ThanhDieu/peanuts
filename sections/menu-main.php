<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$uri = $_SERVER['REQUEST_URI'];
$currentURL = $protocol . $host . $uri;

?>

<section id="menu-main" class="menu-menu position-relative">
    <div class="container  ">
        <div class="row position-relative w-100">
            <div class="col-sm-3">
                <div class="logo">
                    <a href="<?php echo home_url() ?>" class="logo-main w-auto d-inline-block position-absolute">
                        <?php $logo = get_field('logo_main', 'option'); ?>
                        <img loading=“lazy” src="<?php echo $logo['url'] ?? ''; ?>"
                            alt="<?php echo $logo['title'] ?? ''; ?>">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-end align-items-center w-100">
            <div class="col-md-9 col-12 ">
                <div class="d-flex justify-content-end">
                    <nav class="menu-active d-flex align-items-center flex-wrap">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'Menu_Main',
                            // 'depth' => 1
                        ]);
                        ?>
                        <button class="search-button border-0 bg-transparent btn-hover ms-4 d-none d-xl-block"
                            type="button" onclick="toggleSearch()">
                            <?php get_template_part('images/search'); ?>
                        </button>

                        <ul class="d-flex list-none align-items-center flex-wrap d-md-none">
                            <li class="pe-4">
                                <?php $contact = get_field('hd_contact', 'option');
                                ?>
                                <a class=" d-inline-flex m-0 text-uppercase color-main bold fs-16 btn-hover <?php echo $currentURL == $contact['url'] ? 'text-decoration-underline' : '' ?>"
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
                                        <a class="color-main fs-22 px-2 btn-hover"
                                            href="<?php echo get_sub_field('link') ?>"
                                            title="<?php echo get_sub_field('title'); ?>"
                                            target="blank"><?php echo get_sub_field('icon'); ?></a>
                                    </li>
                                    <?php endwhile;
                                        wp_reset_query(); ?>
                                </ul>
                                <?php endif; ?>
                            </li>
                        </ul>

                    </nav>

                    <div class="search-form position-relative" id="search-bar">
                        <div class="search-outer position-absolute d-flex">
                            <button class="search-button border-0 bg-transparent btn-hover" type="button">
                                <?php get_template_part('images/search'); ?>
                            </button>
                            <form action="<?php echo home_url() ?>" method="get" _lpchecked="1">
                                <input id="searchInput" type="text" name="s" id="s" value="" placeholder="Tìm kiếm..."
                                    class="bg-transparent text-white border-0 p-3 w-100" autofocus>
                            </form>
                            <button class="search-button btn-s-close border-0 bg-transparent btn-hover" type="button"
                                onclick="toggleSearch()">
                                <?php get_template_part('images/close') ?>
                            </button>

                        </div>

                    </div>

                    <div class="btn-open align-items-center pl-4 pr-4 d-md-none d-block">
                        <div id="showRightPush" class="position-relative my-4">
                            <div class="line-b"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>