<?php

/**
 * The template for displaying single posts
 *
 * @package EDBA
 */

get_header();
?>

<main id="main" class="site-main single-post">
    <div class="single-post__hero">
        <div class="container">
            <div class="single-post__header">
                <div class="single-post__meta">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<span class="single-post__category">' . esc_html($categories[0]->name) . '</span>';
                    }
                    ?>
                    <span class="single-post__date"><?php echo get_the_date('d.m.Y'); ?></span>
                </div>
                <h1 class="single-post__title"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>

    <?php if (has_post_thumbnail()) : ?>
        <div class="single-post__featured-image-wrapper">
            <div class="container">
                <div class="single-post__featured-image">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="single-post__content">
        <div class="container">
            <div class="single-post__layout">
                <div class="single-post__main">
                    <?php

                    the_content();
                    ?>

                    <div class="single-post__pagination">
                        <div class="pagination-prev">
                            <?php
                            // Use WordPress's built-in post navigation 
                            previous_post_link('%link', '🡨 POPRZEDNI WPIS');
                            ?>
                        </div>

                        <div class="pagination-next">
                            <?php
                            // Use WordPress's built-in post navigation
                            next_post_link('%link', 'NASTĘPNY WPIS 🡪');
                            ?>
                        </div>
                    </div>
                </div>


                <aside class="single-post__sidebar">
                    <!-- Search -->
                    <div class="sidebar-widget sidebar-widget--search">
                        <form class="blog-search" action="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" method="get">
                            <div class="blog-search__input-wrap">
                                <svg class="blog-search__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="24" y1="24" x2="16.65" y2="16.65"></line>
                                </svg>
                                <input type="text" name="s" class="blog-search__input" placeholder="<?php esc_attr_e('Szukaj wpisów', 'edba'); ?>">
                            </div>
                            <button type="submit" class="blog-search__button btn btn--filled">
                                <?php esc_html_e('SZUKAJ', 'edba'); ?>
                            </button>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="sidebar-widget sidebar-widget--categories">
                        <h3 class="sidebar-widget__title"><?php esc_html_e('Kategorie', 'edba'); ?></h3>
                        <div class="sidebar-categories">
                            <?php
                            $categories = get_categories(array(
                                'orderby' => 'name',
                                'order'   => 'ASC'
                            ));

                            foreach ($categories as $category) {
                                printf(
                                    '<a href="%1$s" class="sidebar-categories__item">%2$s</a>',
                                    esc_url(add_query_arg('category', $category->slug, get_permalink(get_option('page_for_posts')))),
                                    esc_html($category->name)
                                );
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    <div class="sidebar-widget sidebar-widget--recent-posts">
                        <h3 class="sidebar-widget__title"><?php esc_html_e('Najnowsze wpisy', 'edba'); ?></h3>
                        <div class="sidebar-posts">
                            <?php
                            $recent_posts = new WP_Query(array(
                                'post_type'      => 'post',
                                'posts_per_page' => 3,
                                'post__not_in'   => array(get_the_ID()) // Exclude current post
                            ));

                            if ($recent_posts->have_posts()) :
                                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                                    <a href="<?php the_permalink(); ?>" class="sidebar-post">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="sidebar-post__image">
                                                <?php the_post_thumbnail('medium', array('class' => 'sidebar-post__thumbnail')); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="sidebar-post__content">
                                            <div class="sidebar-post__meta">
                                                <span class="sidebar-post__date"><?php echo get_the_date('d.m.Y'); ?></span>
                                                <span class="sidebar-post__separator">|</span>
                                                <?php
                                                $categories = get_the_category();
                                                if (!empty($categories)) {
                                                    echo '<span class="sidebar-post__category">' . esc_html($categories[0]->name) . '</span>';
                                                }
                                                ?>
                                            </div>
                                            <h4 class="sidebar-post__title"><?php the_title(); ?> 🡥</h4>
                                        </div>
                                    </a>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="sidebar-social">
                        <h3 class="sidebar-widget__title"><?php esc_html_e('Zaobserwuj nas', 'edba'); ?></h3>
                        <div class="sidebar-social__links">
                            <a href="https://www.facebook.com/" target="_blank" rel="noopener" aria-label="Facebook" class="sidebar-social__icon sidebar-social__icon--fb">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/socialmedia/fb.svg" alt="Facebook" width="32" height="32" loading="lazy">
                            </a>
                            <a href="https://www.linkedin.com/" target="_blank" rel="noopener" aria-label="LinkedIn" class="sidebar-social__icon sidebar-social__icon--linkedin">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/socialmedia/linkedin.svg" alt="LinkedIn" width="32" height="32" loading="lazy">
                            </a>
                            <a href="https://www.instagram.com/" target="_blank" rel="noopener" aria-label="Instagram" class="sidebar-social__icon sidebar-social__icon--ig">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/socialmedia/ig.svg" alt="Instagram" width="32" height="32" loading="lazy">
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>



</main>

<?php
get_footer();
?>