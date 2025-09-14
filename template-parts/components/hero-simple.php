<?php
/**
 * Simple Hero Component
 * 
 * A simplified version of hero with just a title on dark background.
 *
 * @param string $title The title to display (required)
 * @param string $additional_classes Additional classes to add to the hero
 */

// Default parameters if not provided
$title = isset($args['title']) ? $args['title'] : '';
$additional_classes = isset($args['additional_classes']) ? $args['additional_classes'] : '';

// If no title is provided, exit
if (empty($title)) {
    return;
}
?>

<section class="hero-simple <?php echo esc_attr($additional_classes); ?>">
    <div class="hero-simple__overlay"></div>
    
    <div class="container">
        <div class="hero-simple__content">
            <h1 class="hero-simple__title"><?php echo wp_kses_post($title); ?></h1>
        </div>
    </div>
</section>