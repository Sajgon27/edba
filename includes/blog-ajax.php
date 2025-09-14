<?php
/**
 * Blog AJAX Functionality
 *
 * @package EDBA
 */

/**
 * Register AJAX actions
 */
function edba_register_ajax_actions() {
    add_action('wp_ajax_edba_filter_posts', 'edba_ajax_filter_posts');
    add_action('wp_ajax_nopriv_edba_filter_posts', 'edba_ajax_filter_posts');
}
add_action('init', 'edba_register_ajax_actions');

/**
 * AJAX handler for filtering posts
 */
function edba_ajax_filter_posts() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'edba_blog_nonce')) {
        wp_send_json_error('Invalid nonce');
        die();
    }
    
    // Get filter parameters
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    
    // Build query arguments
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 9,
        'paged'          => $page,
    );
    
    // Add category filter if not "all"
    if ($category !== 'all') {
        $args['category_name'] = $category;
    }
    
    // Add search if provided
    if (!empty($search)) {
        $args['s'] = $search;
    }
    
    // Run the query
    $blog_query = new WP_Query($args);
    
    ob_start();
    
    if ($blog_query->have_posts()) {
        $post_count = 0;
        
        // First row (special layout)
        echo '<div class="blog-grid__first-row">';
        
        while ($blog_query->have_posts() && $post_count < 3) {
            $blog_query->the_post();
            
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
        }
        
        echo '</div>'; // End of first row
        
        // Rest of the posts in a standard grid
        if ($post_count < $blog_query->post_count) {
            echo '<div class="blog-grid__standard-rows">';
            
            while ($blog_query->have_posts()) {
                $blog_query->the_post();
                
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
            }
            
            echo '</div>'; // End of standard rows
        }
        
        // Custom Pagination
        echo '<div class="blog-pagination">';
        $total_pages = $blog_query->max_num_pages;
        $current_page = max(1, $page);
        
        // Previous link
        echo '<div class="pagination-prev">';
        if ($current_page > 1) {
            echo '<a href="#" class="page-numbers prev" data-page="' . ($current_page - 1) . '">🡨 POPRZEDNIA STRONA</a>';
        } else {
            echo '<span class="page-numbers prev disabled">🡨 POPRZEDNIA STRONA</span>';
        }
        echo '</div>';
        
        // Next link
        echo '<div class="pagination-next">';
        if ($current_page < $total_pages) {
            echo '<a href="#" class="page-numbers next" data-page="' . ($current_page + 1) . '">NASTĘPNA STRONA 🡪</a>';
        } else {
            echo '<span class="page-numbers next disabled">NASTĘPNA STRONA 🡪</span>';
        }
        echo '</div>';
        echo '</div>';
        
        wp_reset_postdata();
    } else {
        echo '<div class="blog-grid__no-posts">';
        if (!empty($search)) {
            echo '<p>' . esc_html__('Nie znaleziono postów dla podanych kryteriów wyszukiwania.', 'edba') . '</p>';
        } else {
            echo '<p>' . esc_html__('Nie znaleziono postów.', 'edba') . '</p>';
        }
        echo '</div>';
    }
    
    $output = ob_get_clean();
    
    echo $output;
    die();
}