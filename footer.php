	<footer class="site-footer">

	    <div class="site-footer__top">
	        <div class="container">
	            <div class="site-footer__menus">
	                <div class="site-footer__menus-main">
	                    <div class="site-footer__menu-column">
	                        <h4 class="site-footer__menu-title">Oferta</h4>
	                        <?php wp_nav_menu([
                                'theme_location' => 'footer1',
                                'container'      => false,
                                'menu_class'     => 'site-footer__menu',
                                'fallback_cb'    => false,
                            ]); ?>
	                    </div>

	                    <div class="site-footer__menu-column">
	                        <h4 class="site-footer__menu-title">Branże</h4>
	                        <?php wp_nav_menu([
                                'theme_location' => 'footer2',
                                'container'      => false,
                                'menu_class'     => 'site-footer__menu',
                                'fallback_cb'    => false,
                            ]); ?>
	                    </div>

	                    <div class="site-footer__menu-column">
	                        <h4 class="site-footer__menu-title">O firmie</h4>
	                        <?php wp_nav_menu([
                                'theme_location' => 'footer3',
                                'container'      => false,
                                'menu_class'     => 'site-footer__menu',
                                'fallback_cb'    => false,
                            ]); ?>
	                    </div>

	                    <div class="site-footer__menu-column">
	                        <?php wp_nav_menu([
                                'theme_location' => 'footer4',
                                'container'      => false,
                                'menu_class'     => 'site-footer__menu site-footer__menu--standalone',
                                'fallback_cb'    => false,
                            ]); ?>
	                    </div>

	                    <div class="site-footer__menu-column">
	                        <?php wp_nav_menu([
                                'theme_location' => 'footer5',
                                'container'      => false,
                                'menu_class'     => 'site-footer__menu site-footer__menu--standalone',
                                'fallback_cb'    => false,
                            ]); ?>
	                    </div>
	                </div>
	                <div class="site-footer__menu-column site-footer__menu-column--contact">
	                    <div class="site-footer__social">
	                        <a href="#" class="site-footer__social-link" aria-label="Facebook">
	                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/socialmedia/fb.svg" alt="Facebook" />
	                        </a>
	                        <a href="#" class="site-footer__social-link" aria-label="LinkedIn">
	                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/socialmedia/linkedin.svg" alt="LinkedIn" />
	                        </a>
	                        <a href="#" class="site-footer__social-link" aria-label="Instagram">
	                            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/socialmedia/ig.svg" alt="Instagram" />
	                        </a>
	                    </div>
	                    <div class="site-footer__contact-info">
	                        <?php wp_nav_menu([
                                'theme_location' => 'footer6',
                                'container'      => false,
                                'menu_class'     => 'site-footer__menu',
                                'fallback_cb'    => false,
                            ]); ?>

	                    </div>
	                </div>
	            </div>

	        </div>
	    </div>
	    <div class="site-footer__logo container">
	        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/edba.svg" alt="EDBA" class="site-footer__logo-img" />
	    </div>

	    <div class="site-footer__bottom">
	        <div class="container">
	            <div class="site-footer__copyright">
	                <p>Copyright © EDBA 2025. Wszelkie prawa zastrzeżone.</p>
	            </div>
	            <div class="site-footer__certificates">
	                <span class="site-footer__cert-label">Certyfikaty</span>
	                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/certyfikat.webp" alt="Certyfikat" class="site-footer__cert-img" />
	            </div>
	            <div class="site-footer__eu-info">
	                <span class="site-footer__eu-label">Projekt współfinansowany ze środków europejskich</span>
	                <div class="site-footer__eu-logos">
	                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/fundusze.svg" alt="Fundusze Europejskie" class="site-footer__eu-logo" />
	                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/polska.svg" alt="Rzeczpospolita Polska" class="site-footer__eu-logo" />
	                </div>
	            </div>
	        </div>
	    </div>

	</footer>

	<?php wp_footer(); ?>
	</body>

	</html>