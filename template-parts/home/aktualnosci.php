<?php
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$latest_posts = new WP_Query($args);
?>

<section class="aktualnosci">
    <div class="container">
        <div class="aktualnosci__header">
            <span class="aktualnosci__title label"><?php echo esc_html__('AKTUALNOŚCI', 'edba'); ?></span>
        </div>

        <?php if ($latest_posts->have_posts()) : ?>
            <!-- Desktop layout - grid of posts -->
            <div class="aktualnosci__grid desktop-only">
                <?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                    <div class="aktualnosci__item">
                        <h3 class="aktualnosci__item-title"><?php the_title(); ?></h3>
                        <a href="<?php the_permalink(); ?>" class="aktualnosci__item-link btn btn--primary">
                            <?php echo esc_html__('WIĘCEJ', 'edba'); ?>

                        </a>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>

            <!-- Mobile layout - swiper -->
            <div class="aktualnosci__swiper mobile-only">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                            <div class="swiper-slide">
                                <div class="aktualnosci__item">
                                    <h3 class="aktualnosci__item-title"><?php the_title(); ?></h3>
                                    <a href="<?php the_permalink(); ?>" class="aktualnosci__item-link">
                                        <?php echo esc_html__('WIĘCEJ', 'edba'); ?>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z" fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        <?php endif; ?>

        <div class="aktualnosci__footer">
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="aktualnosci__all-link btn btn--filled">
                <?php echo esc_html__('WSZYSTKIE AKTUALNOŚCI', 'edba'); ?>
            </a>
        </div>
    </div>
</section>