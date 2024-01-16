<!-- <div class="loader-outer d-flex align-items-center justify-content-center position-fixed location" id="preloader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div> -->

<div class="loader-outer" id="preloader">
    <div class="loader-container">
        <div class="loader-inner">
            <div class="loader">
                <div id="top" class="mask overflow-hidden">
                    <div class="plane">
                        <?php $logoLoader = get_field('logo_main', 'option'); ?>
                        <img loading=“lazy” src="<?php echo $logoLoader['url'] ?? ''; ?>"
                            alt="<?php echo $logoLoader['title'] ?? ''; ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>