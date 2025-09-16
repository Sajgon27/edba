<section class="hero">
    <video class="hero__bg-video" autoplay loop muted playsinline>
        <source src="<?php echo get_template_directory_uri(); ?>/assets/videos/home-hero.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="hero__bg-overlay"></div>
    <div class="hero__content container">
        <p class="hero__text">
            <?php echo the_field('tekst_hero'); ?>
        </p>
        <div class="hero__cta">
            <span><?php _e('POZNAJ EDBA', 'edba'); ?></span>
            <button class="power-button">
                <div class="power-icon">
                    <div class="power-line"></div>
                </div>
            </button>
        </div>
        <div class="hero__badge">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/home/badge.webp'); ?>" alt="<?php bloginfo('name'); ?>" />
        </div>
    </div>
</section>