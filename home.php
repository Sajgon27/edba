<?php
/**
 * The template for displaying blog posts
 *
 * @package EDBA
 */

get_header();
?>

<main id="main" class="site-main blog-page">
    
    <?php 
    // Include the hero-simple component at the top
    get_template_part('template-parts/components/hero-simple', null, [
        'title' => esc_html__('AKTUALNOŚCI', 'edba'),
    ]); 
    ?>

    <div class="container">
        <!-- Blog Filter Bar -->
        <div class="blog-filter">
            <div class="blog-filter__categories">
                <?php
                // Get current category from URL
                $current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
                
                // "All" link
                $all_class = empty($current_category) ? 'blog-filter__category active' : 'blog-filter__category';
                printf(
                    '<a href="%1$s" class="%2$s" data-category="all">%3$s</a>',
                    esc_url(get_permalink(get_option('page_for_posts'))),
                    esc_attr($all_class),
                    esc_html__('Wszystkie', 'edba')
                );
                
                // Category links
                $categories = get_categories(array(
                    'orderby' => 'name',
                    'order'   => 'ASC'
                ));
                
                foreach ($categories as $category) {
                    $is_active = ($current_category === $category->slug) ? 'blog-filter__category active' : 'blog-filter__category';
                    printf(
                        '<a href="%1$s" class="%2$s" data-category="%3$s">%4$s</a>',
                        esc_url(add_query_arg('category', $category->slug, get_permalink(get_option('page_for_posts')))),
                        esc_attr($is_active),
                        esc_attr($category->slug),
                        esc_html($category->name)
                    );
                }
                ?>
            </div>
            <div class="blog-filter__search">
                <form id="blog-search-form" class="blog-search">
                    <div class="blog-search__input-wrap">
                        <svg class="blog-search__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="24" y1="24" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="hidden" id="blog-page-url" value="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                        <input type="text" id="blog-search-input" class="blog-search__input" placeholder="<?php esc_attr_e('Szukaj wpisów', 'edba'); ?>" value="<?php echo get_search_query(); ?>">
                    </div>
                    <button type="submit" class="blog-search__button btn btn--filled">
                        <?php esc_html_e('SZUKAJ', 'edba'); ?>
                    </button>
                </form>
            </div>
        </div>

        <div id="blog-ajax-container" class="blog-grid">
            <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                'post_type'      => 'post',
                'posts_per_page' => 9,
                'paged'          => $paged,
            );
            
            // Add category filter if specified in URL
            if (!empty($current_category)) {
                $args['category_name'] = $current_category;
            }
            
            // Add search query if specified in URL
            $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
            if (!empty($search_query)) {
                $args['s'] = $search_query;
            }
            $blog_query = new WP_Query( $args );
            
            if ( $blog_query->have_posts() ) :
                $post_count = 0;
                
                // First row (special layout)
                echo '<div class="blog-grid__first-row">';
                
                while ( $blog_query->have_posts() && $post_count < 3 ) : $blog_query->the_post();
                    // First post is larger
                    $post_class = ($post_count === 0) ? 'blog-card blog-card--large' : 'blog-card blog-card--medium';
                    ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                        <a href="<?php the_permalink(); ?>" class="blog-card__link">
                            <div class="blog-card__image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', array('class' => 'blog-card__featured-image')); ?>
                                <?php endif; ?>
                                <div class="blog-card__overlay"></div>
                            </div>
                            
                            <div class="blog-card__content">
                                <h2 class="blog-card__title"><?php the_title(); ?> 🡥</h2>
                                <div class="blog-card__meta">
                                    <span class="blog-card__date"><?php echo get_the_date('d.m.Y'); ?></span>
                                    <span class="blog-card__separator">|</span>
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo '<span class="blog-card__category">' . esc_html($categories[0]->name) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </a>
                    </article>
                    
                    <?php
                    $post_count++;
                endwhile;
                
                echo '</div>'; // End of first row
                
                // Rest of the posts in a standard grid
                if ($post_count < $blog_query->post_count) {
                    echo '<div class="blog-grid__standard-rows">';
                    
                    while ( $blog_query->have_posts() ) : $blog_query->the_post();
                        if ($post_count >= 3) { // Skip the first 3 posts already displayed
                            ?>
                            
                            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                                <a href="<?php the_permalink(); ?>" class="blog-card__link">
                                    <div class="blog-card__image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium_large', array('class' => 'blog-card__featured-image')); ?>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="blog-card__content">
                                        <div class="blog-card__meta">
                                            <span class="blog-card__date"><?php echo get_the_date('d.m.Y'); ?></span>
                                            <span class="blog-card__separator">|</span>
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                echo '<span class="blog-card__category">' . esc_html($categories[0]->name) . '</span>';
                                            }
                                            ?>
                                        </div>
                                        <h2 class="blog-card__title"><?php the_title(); ?> 🡥</h2>
                                    </div>
                                </a>
                            </article>
                            
                            <?php
                        }
                        $post_count++;
                    endwhile;
                    
                    echo '</div>'; // End of standard rows
                }
                
                // Custom Pagination
                echo '<div class="blog-pagination">';
                $total_pages = $blog_query->max_num_pages;
                $current_page = max(1, get_query_var('paged'));
                
                // Previous link
                echo '<div class="pagination-prev">';
                if ($current_page > 1) {
                    $blog_url = get_permalink(get_option('page_for_posts'));
                    $prev_link = add_query_arg('paged', $current_page - 1, $blog_url);
                    
                    // Add current parameters to pagination links
                    if (!empty($current_category)) {
                        $prev_link = add_query_arg('category', $current_category, $prev_link);
                    }
                    
                    if (!empty($search_query)) {
                        $prev_link = add_query_arg('s', $search_query, $prev_link);
                    }
                    
                    echo '<a href="' . esc_url($prev_link) . '" class="page-numbers prev">🡨 POPRZEDNIA STRONA</a>';
                } else {
                    echo '<span class="page-numbers prev disabled">🡨 POPRZEDNIA STRONA</span>';
                }
                echo '</div>';
                
                // Next link
                echo '<div class="pagination-next">';
                if ($current_page < $total_pages) {
                    $blog_url = get_permalink(get_option('page_for_posts'));
                    $next_link = add_query_arg('paged', $current_page + 1, $blog_url);
                    
                    // Add current parameters to pagination links
                    if (!empty($current_category)) {
                        $next_link = add_query_arg('category', $current_category, $next_link);
                    }
                    
                    if (!empty($search_query)) {
                        $next_link = add_query_arg('s', $search_query, $next_link);
                    }
                    
                    echo '<a href="' . esc_url($next_link) . '" class="page-numbers next">NASTĘPNA STRONA 🡪</a>';
                } else {
                    echo '<span class="page-numbers next disabled">NASTĘPNA STRONA 🡪</span>';
                }
                echo '</div>';
                echo '</div>';
                
                wp_reset_postdata();
                
            else :
                ?>
                <div class="blog-grid__no-posts">
                    <p><?php esc_html_e( 'Nie znaleziono postów.', 'edba' ); ?></p>
                </div>
                <?php
            endif;
            ?>
        </div>

        <!-- Loading indicator -->
        <div id="blog-loading" class="blog-loading">
            <div class="blog-loading__spinner"></div>
        </div>
    </div>
</main>

<?php
// Enqueue the blog script
wp_enqueue_script('edba-blog-js', get_template_directory_uri() . '/assets/js/blog.js', array('jquery'), '1.0.0', true);

// Pass data to the script
wp_localize_script('edba-blog-js', 'edbaAjax', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce'   => wp_create_nonce('edba_blog_nonce'),
    'baseUrl' => esc_url(get_permalink(get_option('page_for_posts'))),
));
?>

<?php
get_footer();
?>