<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="https://unpkg.com/lenis@1.3.9/dist/lenis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13/dist/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>


    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="header">
        <div class="header__inner container">
            <a class="header__logo" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo1.svg'); ?>" alt="<?php bloginfo('name'); ?>" />
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo2.svg'); ?>" alt="<?php bloginfo('name'); ?>" />
            </a>
            <div class="header__toggle">
                <svg width="36" height="36" viewBox="0 0 120 90" xmlns="http://www.w3.org/2000/svg">
                    <rect class="line" x="10" y="10" width="100" height="8" />
                    <rect class="line" x="10" y="40" width="80" height="8" />
                    <rect class="line" x="10" y="70" width="60" height="8" />
                </svg>
            </div>
        </div>
        <div class="header__lang-switcher">
            <?php
            $languages = apply_filters('wpml_active_languages', NULL, 'skip_missing=0&orderby=code');

            if (!empty($languages)) {
                echo '<div class="lang-switcher">';
                foreach ($languages as $lang) {
                    $active_class = $lang['active'] ? 'active' : '';
                    echo '<a href="' . esc_url($lang['url']) . '" class="' . $active_class . '">' . esc_html(strtoupper($lang['code'])) . '</a>';
                }
                echo '</div>';
            }
            ?>
        </div>

    </header>

    <!-- Full Screen Menu -->
    <div class="fullscreen-menu">
        <div class="fullscreen-menu__header">
            <div class="fullscreen-menu__inner ">
                <div class="fullscreen-menu__logo-container">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="fullscreen-menu__logo">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo1.svg'); ?>" alt="<?php bloginfo('name'); ?>" />
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo2.svg'); ?>" alt="<?php bloginfo('name'); ?>" />
                    </a>
                    <div class="fullscreen-menu__close">
                        <svg width="48" height="48" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                            <line class="close-line" x1="30" y1="30" x2="90" y2="90" stroke="white" stroke-width="8" />
                            <line class="close-line" x1="90" y1="30" x2="30" y2="90" stroke="white" stroke-width="8" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="fullscreen-menu__content">
            <div class="fullscreen-menu__image">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/header.webp'); ?>" alt="Menu Background" />
            </div>
            <div class="fullscreen-menu__right">
                <div class="fullscreen-menu__nav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary_desktop',
                        'menu_class' => 'fullscreen-menu__primary',
                        'container' => false,
                        'depth' => 2,
                        'walker' => new Custom_Walker_Nav_Menu()
                    ));
                    ?>
                </div>
                <div class="fullscreen-menu__footer">
                    <div class="fullscreen-menu__contact">
                        <div class="contact-info">
                            <h6>Dane kontaktowe:</h6>
                            <div class="contact-info__inner">
                                <div class="contact-data">
                                    <a href="mailto:info@edba.pl">info@edba.pl</a>
                                    <a href="tel:+48600500400">+48 600 500 400</a>
                                </div>
                                <div class="contact-address">
                                    <p>Myślęcin 6a, 82-310 Elbląg 2</p>
                                    <p>NIP 5882490060</p>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="fullscreen-menu__social">
                        <h6>Obserwuj nas na:</h6>
                        <div class="social-icons">
                            <a href="#" aria-label="Facebook">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/socialmedia/fb.svg'); ?>" alt="Facebook" />
                            </a>
                            <a href="#" aria-label="LinkedIn">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/socialmedia/linkedin.svg'); ?>" alt="LinkedIn" />
                            </a>
                            <a href="#" aria-label="Instagram">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/icons/socialmedia/ig.svg'); ?>" alt="Instagram" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>